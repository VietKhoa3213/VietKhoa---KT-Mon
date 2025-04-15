<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $table = 'news'; 

    protected $fillable = [
        'title',
        'content',
        'image',
        'author_id',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean', 
    ];


    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}