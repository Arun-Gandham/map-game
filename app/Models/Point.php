<?php

namespace App\Models;

use App\Models\type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'type', // Add type to the fillable fields
        'lat_long', // Add latitude to the fillable fields
        'distance',
        'image',
        'description',
        'question',
        'question_des',
        'answer',
    ];

    public function type_obj()
    {
        return $this->hasOne(type::class, 'id', 'type');
    }

}
