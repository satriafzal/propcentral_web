<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ─── Dashboard ───────────────────────────────────────────
    public function dashboard()
    {
        $totalUsers      = User::count();
        $totalProperties = Property::count();
        $totalOffers     = Offer::count();

        $latestUsers      = User::latest()->take(5)->get();
        $latestProperties = Property::with(['user', 'images'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalProperties', 'totalOffers',
            'latestUsers', 'latestProperties'
        ));
    }

    // ─── Manajemen User ──────────────────────────────────────
    public function users(Request $request)
    {
        $query = User::withCount('properties');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('username', 'like', "%$s%");
            });
        }

        $users = $query->latest()->paginate(15)->appends($request->query());

        return view('admin.users', compact('users'));
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        // Cegah hapus akun admin sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun admin yang sedang aktif.');
        }

        // Hapus properti beserta gambarnya
        foreach ($user->properties as $property) {
            foreach ($property->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }
            $property->images()->delete();
            $property->delete();
        }

        $user->forceDelete();

        return back()->with('success', 'Akun user berhasil dihapus.');
    }

    // ─── Manajemen Properti ──────────────────────────────────
    public function properties(Request $request)
    {
        $query = Property::with(['user', 'images']);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%$s%")
                  ->orWhere('city', 'like', "%$s%")
                  ->orWhere('address', 'like', "%$s%");
            });
        }

        $properties = $query->latest()->paginate(15)->appends($request->query());

        return view('admin.properties', compact('properties'));
    }

    public function destroyProperty($id)
    {
        $property = Property::with('images')->findOrFail($id);

        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        $property->images()->delete();
        $property->offers()->delete();
        $property->delete();

        return back()->with('success', 'Properti berhasil dihapus.');
    }

    // ─── Manajemen Penawaran ─────────────────────────────────
    public function offers(Request $request)
    {
        $query = Offer::with(['property', 'buyer', 'seller']);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->whereHas('property', function ($q) use ($s) {
                $q->where('title', 'like', "%$s%");
            })->orWhereHas('buyer', function ($q) use ($s) {
                $q->where('nama', 'like', "%$s%")->orWhere('email', 'like', "%$s%");
            });
        }

        $offers = $query->latest()->paginate(15)->appends($request->query());

        return view('admin.offers', compact('offers'));
    }
}
