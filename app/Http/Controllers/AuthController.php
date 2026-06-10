<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\VerifyRegistrationMail;

class AuthController extends Controller
{
    // LOGIC REGISTER
    public function registerPost(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:6',
                'regex:/[A-Z]/',
                'regex:/[^a-zA-Z0-9]/',
                'confirmed'
            ]
        ], [
            'username.unique' => 'Username sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf besar dan satu karakter spesial.'
        ]);

        // Generate 6 digit token
        $token = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        // Simpan token ke password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        // Simpan data pendaftar sementara di session
        session([
            'pending_registration' => [
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        ]);
        session()->flash('show_register_verify_modal', true);

        // Kirim email
        Mail::to($request->email)->send(new VerifyRegistrationMail($token));

        return back()->with('success', 'Kode verifikasi telah dikirim ke email Anda.');
    }

    public function verifyRegisterPost(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        $pendingUser = session('pending_registration');

        if (!$pendingUser) {
            return back()->with('error', 'Sesi pendaftaran habis. Silakan daftar ulang.');
        }

        $record = DB::table('password_reset_tokens')
            ->where('email', $pendingUser['email'])
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            session()->flash('show_register_verify_modal', true);
            return back()->withErrors(['token' => 'Kode verifikasi tidak valid atau salah.'])->withInput();
        }

        // Token valid, hapus record token
        DB::table('password_reset_tokens')->where('email', $pendingUser['email'])->delete();

        // Buat user
        $user = User::create([
            'nama' => $pendingUser['username'],
            'username' => $pendingUser['username'],
            'email' => $pendingUser['email'],
            'password' => $pendingUser['password'],
            'no_telp' => '-'.time(), 
            'alamat' => '-',
            'foto_profil' => null,
        ]);

        // Hapus session sementara
        $request->session()->forget(['pending_registration', 'show_register_verify_modal']);

        Auth::login($user);

        return redirect('/')->with('success', 'Pendaftaran berhasil diverifikasi!');
    }

    public function resendRegisterOtp(Request $request)
    {
        $pendingUser = session('pending_registration');

        if (!$pendingUser) {
            return back()->with('error', 'Sesi pendaftaran habis. Silakan daftar ulang.');
        }

        // Generate 6 digit token baru
        $token = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        // Update token di database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $pendingUser['email']],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        // Kirim ulang email
        Mail::to($pendingUser['email'])->send(new VerifyRegistrationMail($token));

        // Tampilkan modal lagi
        session()->flash('show_register_verify_modal', true);

        return back()->with('success', 'Kode verifikasi baru telah dikirim ke email Anda.');
    }

    // LOGIC LOGIN
    public function loginPost(Request $request)
    {
        // Hapus session registrasi jika user mencoba login
        $request->session()->forget(['pending_registration', 'show_register_verify_modal']);

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/property')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    // LOGIC LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout!');
    }
}