<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [  ];
    
    //A task Belongs to a User
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function titles(){
        return $this->hasMany(Titles::class);
    }
}
