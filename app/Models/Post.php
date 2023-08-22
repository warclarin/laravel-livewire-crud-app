<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'featured_image' => 'array'
    ];

    protected $fillable = ['title', 'slug', 'content', 'featured_image'];
}
