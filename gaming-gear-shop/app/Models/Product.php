<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'brand_id',
        'description',
        'specifications',
        'price',
        'discount_price',
        'stock_quantity',
        'image',
        'gallery',
        'unit',
        'is_new',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2', 
        'discount_price' => 'decimal:2',
        'stock_quantity' => 'integer',
        'is_new' => 'boolean',
        'is_featured' => 'boolean',
        'status' => 'boolean',
        'specifications' => 'array', 
        'gallery' => 'array',      
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

 
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

//     public function getSpecificationsAttribute($value)
//     {
//     if (empty($value)) {
//         return [];
//     }
    
//     if (is_string($value)) {
//         return json_decode($value, true) ?? [];
//     }
    
//     return $value;
//     }

//     public function setSpecificationsAttribute($value)
//     {
//         if (is_array($value)) {
//             $this->attributes['specifications'] = json_encode($value);
//         } else {
//             $this->attributes['specifications'] = null;
//         }
//     }

//     public function getGalleryAttribute($value)
// {
//     if (empty($value)) {
//         return [];
//     }
    
//     if (is_string($value)) {
//         return json_decode($value, true) ?? [];
//     }
    
//     return $value;
// }
}