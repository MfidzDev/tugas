<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'slug'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function image(): Attribute {
        return Attribute::make(
            get: fn ($image) => asset('/storage/categories/' . $image),
        );
    }
}
