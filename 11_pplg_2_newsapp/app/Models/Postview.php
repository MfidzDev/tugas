<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postview extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 'views'
    ];

}
