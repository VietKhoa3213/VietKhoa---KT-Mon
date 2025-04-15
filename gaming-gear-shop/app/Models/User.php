<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract; 
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Casts\Attribute; 
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use App\Notifications\CustomResetPasswordNotification;

class User extends Authenticatable implements CanResetPasswordContract
{
    use HasFactory, Notifiable, CanResetPassword; 


    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'gender',
        'level',
        'avatar',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', 
        'level' => 'integer',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // public function wishlists()
    // {
    //     return $this->hasMany(Wishlist::class);
    // }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function news()
    {
        return $this->hasMany(News::class, 'author_id');
    }

   
    public function wishlistedProducts(): BelongsToMany
    {
        try {
            return $this->belongsToMany(Product::class, 'wishlists', 'user_id', 'product_id')
                        ->withTimestamps();
        } catch (\Exception $e) {
            Log::error('Error in wishlistedProducts relationship', [
                'user_id' => $this->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function hasWishlisted(Product $product): bool
    {
        return $this->wishlistedProducts()->where('product_id', $product->id)->exists();
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new CustomResetPasswordNotification($token)); 
    }
}