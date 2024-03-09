<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FootballClub extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'country',
        'phone',
        'contact',
        'website',
        'status',
        'payment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function players()
    {
        return $this->belongsToMany(Player::class, 'club_player')->withTimestamps();
    }
}
