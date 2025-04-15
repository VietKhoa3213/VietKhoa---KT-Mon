<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    const STATUS_PENDING    = 'pending';    
    const STATUS_PROCESSING = 'processing'; 
    const STATUS_SHIPPED    = 'shipped';    
    const STATUS_DELIVERED  = 'delivered';  
    const STATUS_CANCELLED  = 'cancelled';  

    protected $fillable = [
        'code',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'order_date',
        'total_amount',
        'shipping_fee',
        'discount_amount',
        'final_amount',
        'payment_method',
        'payment_status',
        'shipping_status', 
        'note',
        'admin_note',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'total_amount' => 'decimal:0', 
        'shipping_fee' => 'decimal:0',
        'discount_amount' => 'decimal:0',
        'final_amount' => 'decimal:0',
    ];

 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

 
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public static function getAllStatuses(): array
    {
        return [
            self::STATUS_PENDING    => 'Mới (Chờ xử lý)',
            self::STATUS_PROCESSING => 'Đang xử lý',
            self::STATUS_SHIPPED    => 'Đang giao hàng',
            self::STATUS_DELIVERED  => 'Đã giao hàng',
            self::STATUS_CANCELLED  => 'Đã hủy',
        ];
    }

    public function getStatusTextAttribute(): string
    {
         return self::getAllStatuses()[$this->shipping_status] ?? 'Không xác định';
    }

  
    public function getStatusClassAttribute(): string 
    {
        switch ($this->shipping_status) {
            case self::STATUS_PENDING:
                return 'badge-status-pending'; 
            case self::STATUS_PROCESSING:
                return 'badge-status-processing'; 
            case self::STATUS_SHIPPED:
                return 'badge-status-shipped'; 
            case self::STATUS_DELIVERED:
                return 'badge-status-delivered'; 
            case self::STATUS_CANCELLED:
                return 'badge-status-cancelled'; 
            default:
                return 'badge-status-default'; 
        }
    }

    
}