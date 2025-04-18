<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;
    
    protected $table = 'slide';
    protected $fillable = [
        'title',
        'description',
        'link',
        'image',
        'sort_order',
        'status',
    ];

     protected $casts = [
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];


}