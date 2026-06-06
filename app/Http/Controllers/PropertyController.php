<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index()
    {
        // Get all properties with their images and owner
        $properties = Property::with(['images', 'user'])->latest()->get();
        return view('property', compact('properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'required|string',
            'land_area' => 'required|numeric',
            'building_area' => 'required|numeric',
            'bedroom' => 'required|integer',
            'bathroom' => 'required|integer',
            'garage' => 'required|integer',
            'certificate' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'images' => 'required|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048', // 2MB max
        ]);

        $property = Property::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'type' => $request->type,
            'land_area' => $request->land_area,
            'building_area' => $request->building_area,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'garage' => $request->garage,
            'certificate' => $request->certificate,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('property_images', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect('/property')->with('success', 'Iklan properti berhasil diterbitkan!');
    }

    public function show($id)
    {
        $property = Property::with(['images', 'user'])->findOrFail($id);
        return view('property-detail', compact('property'));
    }

    public function myOffers() {
        $properties = \App\Models\Property::with('images')
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->latest()
            ->get();
        return view('penawaran_saya', compact('properties'));
    }

    public function destroy($id) {
        // get all propery data with images
        $property = \App\Models\Property::with('images')->where('id', $id)->firstOrFail();

        // check if the property belongs to the authenticated user
        if ($property->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403, 'Anda tidak punya akses untuk menghapus properti ini.');
        }

        // delete images from storage
        foreach ($property->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        }

        // delete property in db
        $property->delete();

        return back()->with('success', 'Iklan properti berhasil dihapus!');
    }

    public function edit($id) {
        // get all data and images of the property
        $property = \App\Models\Property::with('images')->findOrFail($id);

        // check if the property belongs to the authenticated user
        if ($property->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah properti ini.');
        }

        return view('property_edit', compact('property'));
    }

    public function update(\Illuminate\Http\Request $request, $id) {
        $property = \App\Models\Property::with('images')->findOrFail($id);

        if ($property->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah properti ini.');
        }

        // validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'required|string',
            'land_area' => 'required|numeric',
            'building_area' => 'required|numeric',
            'bedroom' => 'required|integer',
            'bathroom' => 'required|integer',
            'garage' => 'required|integer',
            'certificate' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // update data teks prooperty
        $property->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'type' => $request->type,
            'land_area' => $request->land_area,
            'building_area' => $request->building_area,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'garage' => $request->garage,
            'certificate' => $request->certificate,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // logic image if user upload new images, then delete old images and upload new ones. if not, keep the old images as they are
        if ($request->hasFile('images')) {
            foreach ($property->images as $image) {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($image->image_path)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image_path);
                }
                $image->delete(); 
            }

            // upload new images to storage and save to db
            foreach ($request->file('images') as $image) {
                $path = $image->store('property_images', 'public');
                \App\Models\PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect('/penawaran-saya')->with('success', 'Iklan properti berhasil diperbarui!');
    }
}