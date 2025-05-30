<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory; 
      // Primární klíč
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','src', 'description', 'alt', 'title'
    ];
}
