<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goalie extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'surname', 'team_id', 'shutouts', 'gaa', 'assists', 'jersey_number', 'image_name'];
    protected $primaryKey = 'goalie_id';


    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
