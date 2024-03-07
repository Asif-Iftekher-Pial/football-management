<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherFootballJobs extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','name','dob','position','about_you','experience','phone','address','status'];
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
