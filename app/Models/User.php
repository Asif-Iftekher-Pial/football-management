<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Player;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function football_group_staffs()
    {
        return $this->hasMany(FootballGroupStaff::class, 'user_id', 'id');
    }
    public function player()
    {
        return $this->hasOne(Player::class,'user_id','id');
    }
    public function manager()
    {
        return $this->hasOne(Manager::class,'user_id','id');
    }

    public function players()
    {
        return $this->hasMany(Player::class,'id','player_id');
    }
    public function other_football_job()
    {
        return $this->hasOne(OtherFootballJobs::class,'user_id','id');
    }

    public function football_club()
    {
        return $this->hasOne(FootballClub::class,'user_id','id');
    }
}
