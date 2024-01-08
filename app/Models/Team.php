<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\PlayerHistory;

class Team extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'team_id';
    protected $fillable = ['logo_filename', 'team_name'];

    public function users()
    {
        return $this->hasMany(User::class, 'favorite_team_id');
    }

    public function players()
    {
        return $this->hasMany(Player::class, 'team_id');
    }

    public function playerHistories()
    {
        return $this->hasMany(PlayerHistory::class, 'team_id', 'id');
    }
}
