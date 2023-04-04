<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post_id',
        'post_title',
        'post_description',
        'post_image',
        'category_id'
    ];
    use HasFactory;
}
