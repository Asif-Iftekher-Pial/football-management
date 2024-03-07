<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'blood_type',
        'allergies',
        'previous_injuries',
        'about_player',
    ];
}
