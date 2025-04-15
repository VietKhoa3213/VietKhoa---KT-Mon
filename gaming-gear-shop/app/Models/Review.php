<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    const STATUS_PENDING = 0; // Trạng thái Chờ duyệt
    const STATUS_APPROVED = 1; // Trạng thái Đã duyệt
    const STATUS_REJECTED = 2; // Trạng thái Từ chối

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
        'status',
    ];

    protected $casts = [
        'rating' => 'integer',
        'status' => 'integer', 
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getStatusTextAttribute(): string
    {
        switch ($this->status) {
            case self::STATUS_APPROVED: return 'Đã duyệt';
            case self::STATUS_REJECTED: return 'Bị từ chối';
            case self::STATUS_PENDING:
            default: return 'Chờ duyệt';
        }
    }

    public function getStatusClassAttribute(): string
    {
        switch ($this->status) {
            case self::STATUS_APPROVED: return 'success'; 
            case self::STATUS_REJECTED: return 'danger';  
            case self::STATUS_PENDING:
            default: return 'warning'; 
        }
    }
}
