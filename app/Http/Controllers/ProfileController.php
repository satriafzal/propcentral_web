<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // get user data 
        $user = Auth::user();

        // validation input user
        $request->validate([
            'username' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20|unique:users,no_telp,' . $user->id,
        ]);

        // repleace new data from user
        $user->username = $request->username;
        $user->no_telp = $request->no_telp;
        
        // Save to database
        $user->save();

        return back()->with('success', 'Informasi pribadi berhasil diupdate!');
    }

    public function updatePhoto(Request $request)
    {
        // Validasi biar yang diupload beneran gambar, maksimal 2MB
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $user = Auth::user();

        if ($request->hasFile('foto')) {
            // Hapus foto lama dari folder biar server lu ga kepenuhan
            if ($user->foto_profil && Storage::exists('public/' . $user->foto_profil)) {
                Storage::delete('public/' . $user->foto_profil);
            }

            // Simpan foto baru ke folder: storage/app/public/profile_photos
            $path = $request->file('foto')->store('profile_photos', 'public');
            
            // Simpan nama path ke database (sesuaikan nama kolomnya)
            $user->foto_profil = $path;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diupdate!');
    }
}