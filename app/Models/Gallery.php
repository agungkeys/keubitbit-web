<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'detail', 'image'
    ];

    public function photo()
    {
        return $this->hasMany(Photo::class, 'gallery_id');
    }
}
