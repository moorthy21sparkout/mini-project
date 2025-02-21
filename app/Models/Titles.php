<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titles extends Model
{
    use HasFactory;
    protected $fillable=[
        'task_id',
        'title',            //task time
        'description',      //task description
        'due_date',         //Due date
        'datetime_field',
        'attachment' ,       //file attachment
        'status'
    ];
    public function tasks(){
        return $this->belongsTo(Task::class,'task_id');
    }
}
