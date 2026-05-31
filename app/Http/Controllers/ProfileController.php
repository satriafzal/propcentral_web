<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // 1. Ambil data user yang lagi login
        $user = Auth::user();

        // 2. Validasi inputan
        $request->validate([
            'username' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20|unique:users,no_telp,' . $user->id,
        ]);

        // 3. Timpa data lama pake data baru yang diketik
        $user->username = $request->username;
        $user->no_telp = $request->no_telp;
        
        // 4. Save ke database!
        $user->save();

        return back()->with('success', 'Informasi pribadi berhasil diupdate!');
    }
}