<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'property_id',
        'buyer_id',
        'seller_id',
        'offered_price',
        'original_price',
        'message',
        'status',
        'counter_price',
        'counter_message',
        'responded_at',
        'is_read_by_seller',
        'is_read_by_buyer',
    ];
    protected $casts = [
        'responded_at' => 'datetime',
    ];


    // Properti yang ditawar
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Siapa yang menawar (pembeli)
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // Pemilik properti (penjual)
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
