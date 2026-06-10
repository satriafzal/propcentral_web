<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Mail\ResetPasswordMail;

class PasswordResetController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Email ini tidak terdaftar di sistem kami.'
        ]);

        $token = sprintf("%06d", mt_rand(1, 999999));

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return redirect('/verify-email')->with('email', $request->email)->with('success', 'Kode verifikasi telah dikirim ke email Anda.');
    }

    public function showVerifyForm(Request $request)
    {
        return view('auth.verify-email');
    }

    public function verifyToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string|size:6'
        ]);

        $resetToken = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetToken) {
            return back()->with('error', 'Kode verifikasi salah.')->with('email', $request->email);
        }

        $tokenAge = Carbon::parse($resetToken->created_at)->diffInMinutes(Carbon::now());
        if ($tokenAge > 60) {
            return back()->with('error', 'Kode verifikasi sudah kadaluarsa.')->with('email', $request->email);
        }

        $request->session()->put('reset_email', $request->email);
        $request->session()->put('reset_token', $request->token);

        return redirect('/reset-password')->with('success', 'Kode berhasil diverifikasi. Silakan masukkan password baru.');
    }

    public function showResetForm(Request $request)
    {
        if (!$request->session()->has('reset_email') || !$request->session()->has('reset_token')) {
            return redirect('/forgot-password')->with('error', 'Silakan verifikasi email Anda terlebih dahulu.');
        }

        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        if (!$request->session()->has('reset_email') || !$request->session()->has('reset_token')) {
            return redirect('/forgot-password')->with('error', 'Sesi Anda telah berakhir.');
        }

        $email = $request->session()->get('reset_email');
        
        $request->validate([
            'password' => [
                'required',
                'min:8',
                'regex:/\d/',
                'regex:/[!@#$%^&*()+=._-]/',
                'confirmed'
            ]
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex' => 'Password harus mengandung angka dan karakter spesial.',
            'password.min' => 'Password minimal 8 karakter.'
        ]);

        $user = User::where('email', $email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        DB::table('password_reset_tokens')->where('email', $email)->delete();

        $request->session()->forget(['reset_email', 'reset_token']);

        return redirect('/')->with('success', 'Password berhasil diubah. Silakan masuk menggunakan password baru.');
    }
}
