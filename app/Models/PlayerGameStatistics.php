<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerGameStatistics extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'player_id', 'goals', 'assists', 'time_on_ice', 'points', 'plus_minus'];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
}
