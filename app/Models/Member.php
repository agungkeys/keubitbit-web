<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'slug', 
        'position', 
        'detail', 
        'image', 
        'social_facebook', 
        'social_instagram',
        'social_twitter',
        'social_tiktok',
        'social_youtube',
        'social_linktree'
    ];
}
