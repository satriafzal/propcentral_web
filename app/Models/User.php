<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'username',
        'no_telp',
        'email',
        'alamat',
        'foto_profil',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function conversations()
    {
        return Conversation::where('user_one_id', $this->id)
            ->orWhere('user_two_id', $this->id);
    }

    // Penawaran yang diajukan user (sebagai pembeli)
    public function offersAsBuyer()
    {
        return $this->hasMany(Offer::class, 'buyer_id');
    }

    // Penawaran yang masuk ke user (sebagai penjual)
    public function offersAsSeller()
    {
        return $this->hasMany(Offer::class, 'seller_id');
    }

    // Ulasan yang diterima
    public function reviews()
    {
        return $this->hasMany(UserReview::class, 'user_id');
    }

    // Ulasan yang diberikan
    public function givenReviews()
    {
        return $this->hasMany(UserReview::class, 'reviewer_id');
    }
}
