<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stars extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'birth_date', 'birth_place', 'biography', 'image'];
}
