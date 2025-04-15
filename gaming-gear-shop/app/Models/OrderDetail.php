<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot; 

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details'; 

    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'quantity',
        'price',      
    ];

     protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}