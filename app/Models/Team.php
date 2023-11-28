<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'team_id'; // Specify the actual primary key column name
    protected $fillable = ['logo_filename', 'team_name']; // Add other fillable attributes as needed

    public function users()
    {
        return $this->hasMany(User::class, 'favorite_team_id');
    }
}
