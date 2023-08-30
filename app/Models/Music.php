<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'slug', 
        'detail', 
        'date_release',
        'image', 
        'iframe',
        'link_spotify',
        'link_youtube',
        'link_apple',
        'is_featured'
    ];
}
