<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $fillable = ['name', 'class_id', 'birthday', 'gender', 'avatar', 'phone_number','user_id'];

    public function classRelation()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class,'student_id','id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'marks');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
