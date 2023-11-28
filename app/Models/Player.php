<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'surname', 'position', 'image_name'];
    protected $primaryKey = 'player_id'; // Set the primary key column name

    public function playerHistory()
{
    return $this->hasOne(PlayerHistory::class, 'player_id');

}


}
