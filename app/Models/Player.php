<?php

namespace App\Models;

use App\Models\FootballClub;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'video',
        'gender',
        'age',
        'dob',
        'height',
        'weight',
        'favourite_foot',
        'position',
        'nationality',
        'passport_type',
        'is_passport_more_then_one',
        'current_club',
        'international_appearance',
        'contract_length',
        'football_group_player',
        'other_info',
        'phone',
        'address',
        'payment_status',
        'player_represent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function medical_info()
    {
        return $this->hasOne(MedicalInfo::class,'player_id','id');
    }
    public function clubs()
    {
        return $this->belongsToMany(FootballClub::class, 'club_player')->withTimestamps();
    }
}
