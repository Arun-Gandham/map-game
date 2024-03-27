<?php

namespace App\Models;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'game_id',
    ];

    public function game()
    {
        return $this->hasOne(Game::class, 'id', 'game_id');
    }
}
