<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPartner extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','name','address','country','telephone','contact','website','status','payment_status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
