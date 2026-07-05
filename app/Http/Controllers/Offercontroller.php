<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Offercontroller extends Controller
{
    /**
     * Pembeli mengajukan penawaran baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id'   => 'required|exists:properties,id',
            'offered_price' => 'required|numeric|min:1',
            'message'       => 'nullable|string|max:500',
        ]);

        $property = Property::findOrFail($request->property_id);

        // Tidak boleh tawar properti sendiri
        if ($property->user_id === Auth::id()) {
            return back()->with('error', 'Kamu tidak bisa menawar properti sendiri.');
        }

        // Cek apakah sudah ada penawaran aktif untuk properti ini
        $existing = Offer::where('property_id', $property->id)
            ->where('buyer_id', Auth::id())
            ->whereIn('status', ['pending', 'countered'])
            ->first();

        if ($existing) {
            return back()->with('error', 'Kamu sudah punya penawaran aktif untuk properti ini.');
        }

        $offer = Offer::create([
            'property_id'    => $property->id,
            'buyer_id'       => Auth::id(),
            'seller_id'      => $property->user_id,
            'offered_price'  => $request->offered_price,
            'original_price' => $property->price,
            'message'        => $request->message,
            'status'         => 'pending',
            'is_read_by_seller' => false,
            'is_read_by_buyer'  => true,
        ]);

        broadcast(new \App\Events\OfferUpdated($offer, $property->user_id));

        return back()->with('success', 'Penawaran berhasil dikirim! Tunggu respons dari penjual.');
    }

    /**
     * Penjual melihat semua penawaran yang masuk
     */
    public function incomingOffers()
    {
        $offers = Offer::with(['property.images', 'buyer'])
            ->where('seller_id', Auth::id())
            ->latest()
            ->get();

        // Tandai semua sudah dibaca oleh penjual
        Offer::where('seller_id', Auth::id())
            ->where('is_read_by_seller', false)
            ->update(['is_read_by_seller' => true]);

        return view('penawaran_masuk', compact('offers'));
    }

    /**
     * Pembeli melihat penawaran yang dia ajukan
     */
    public function myOffers()
    {
        $offers = Offer::with(['property.images', 'seller'])
            ->where('buyer_id', Auth::id())
            ->latest()
            ->get();

        // Tandai sudah dibaca oleh pembeli
        Offer::where('buyer_id', Auth::id())
            ->where('is_read_by_buyer', false)
            ->update(['is_read_by_buyer' => true]);

        return view('penawaran_diajukan', compact('offers'));
    }

    /**
     * Penjual merespons: terima / tolak / counter
     */
    public function respond(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);
        $user_id = Auth::id();

        // Jika PENJUAL yang merespons
        if ($offer->seller_id === $user_id) {
            $request->validate([
                'action'          => 'required|in:accept,reject,counter',
                'counter_price'   => 'required_if:action,counter|nullable|numeric|min:1',
                'counter_message' => 'nullable|string|max:500',
            ]);

            $statusMap = [
                'accept'  => 'accepted',
                'reject'  => 'rejected',
                'counter' => 'countered',
            ];

            $offer->update([
                'status'           => $statusMap[$request->action],
                'counter_price'    => $request->action === 'counter' ? $request->counter_price : null,
                'counter_message'  => $request->action === 'counter' ? $request->counter_message : $offer->counter_message,
                'responded_at'     => now(),
                'is_read_by_buyer' => false,
            ]);

            $messages = [
                'accept'  => 'Penawaran berhasil diterima! 🎉',
                'reject'  => 'Penawaran telah ditolak.',
                'counter' => 'Counter penawaran berhasil dikirim.',
            ];

            broadcast(new \App\Events\OfferUpdated($offer, $offer->buyer_id));

            return back()->with('success', $messages[$request->action]);
        }

        // Jika PEMBELI yang merespons (saat counter ATAU saat ditolak)
        if ($offer->buyer_id === $user_id && in_array($offer->status, ['countered', 'rejected'])) {
            $request->validate([
                'action'    => 'required|in:accept,reject,re_offer',
                'new_price' => 'required_if:action,re_offer|nullable|numeric|min:1',
                'message'   => 'nullable|string|max:500',
            ]);

            // Pembeli ajukan harga baru → buat record BARU, biarkan yang lama tetap
            if ($request->action === 're_offer') {
                $newOffer = Offer::create([
                    'property_id'       => $offer->property_id,
                    'buyer_id'          => $offer->buyer_id,
                    'seller_id'         => $offer->seller_id,
                    'offered_price'     => $request->new_price,
                    'original_price'    => $offer->original_price,
                    'message'           => $request->message,
                    'status'            => 'pending',
                    'is_read_by_seller' => false,
                    'is_read_by_buyer'  => true,
                ]);
                broadcast(new \App\Events\OfferUpdated($newOffer, $newOffer->seller_id));
                return back()->with('success', 'Penawaran baru berhasil diajukan! 🎉');
            }

            // Hanya boleh accept jika statusnya countered (ada harga counter dari penjual)
            if ($request->action === 'accept' && $offer->status !== 'countered') {
                return back()->with('error', 'Tidak ada penawaran yang bisa disetujui.');
            }

            $statusMap = [
                'accept'  => 'accepted',
                'reject'  => 'rejected',
            ];

            $offer->update([
                'status'            => $statusMap[$request->action],
                'responded_at'      => now(),
                'is_read_by_seller' => false,
            ]);

            $messages = [
                'accept'  => 'Counter penawaran berhasil disetujui! 🎉',
                'reject'  => 'Penawaran telah diselesaikan.',
            ];

            broadcast(new \App\Events\OfferUpdated($offer, $offer->seller_id));

            return back()->with('success', $messages[$request->action]);
        }

        // Jika bukan penjual dan bukan pembeli yang dituju
        abort(403);
    }
}
