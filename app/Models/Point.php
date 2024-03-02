<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $fillable = [
        'type', // Add type to the fillable fields
        'lat&long', // Add latitude to the fillable fields
        'distance',
        'image', 
        'description'
    ];
   
}
