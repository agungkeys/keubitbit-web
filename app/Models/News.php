<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'detail', 'image', 'reference', 'is_active', 'user_id'
    ];
}
