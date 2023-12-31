<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'surname', 'position', 'image_name'];
    protected $primaryKey = 'player_id';

    public function playerHistory()
    {
        return $this->hasOne(PlayerHistory::class, 'player_id');
    }

public function playerGameStatistics()
    {
        return $this->hasMany(PlayerGameStatistics::class, 'player_id');
    }


}
