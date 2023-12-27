<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'game_id';
    protected $fillable = [
        'start_time',
        'date',
        'game_status',
        'home_team_id',
        'away_team_id',
        'home_team_score',
        'away_team_score',
        'winning_team_id',
        'home_team_shots_on_goal',
        'away_team_shots_on_goal',
        'blocks',
        'power_play_count',
        'season_id'
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function playerStatistics()
    {
        return $this->hasMany(PlayerGameStatistics::class, 'game_id');
    }

    public function getPlayerGameStatistics()
    {
        return $this->playerStatistics()->get();
    }
}
