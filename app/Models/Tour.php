<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'slug', 
        'detail', 
        'date_gigs',
        'location',
        'image', 
        'link',
        'is_active'
    ];
}
