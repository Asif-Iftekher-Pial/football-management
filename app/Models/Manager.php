<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'video',
        'address',
        'age',
        'dob',
        'nationality',
        'football_club_manage',
        'coaching_badges',
        'qualification',
        'honours',
        'international_team_managed',
        'status',
        'payment_status',
    ];

      public function user()
      {
          return $this->belongsTo(User::class,'user_id','id');
      }     
}
