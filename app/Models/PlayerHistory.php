<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerHistory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'player_history';
    protected $fillable = ['team_id', 'jersey_number', 'player_id', 'season_id'];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id', 'season_id');
    }

}
