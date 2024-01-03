<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamParticipation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['team_id', 'game_id'];

    protected $table = 'team_participation';

    protected $primaryKey = 'participation_id';

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
