<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable=['name','faculty_id','id'];

    public function faculty() {
        return $this->belongsTo(Faculty::class,'faculty_id','id');
    }

    public function students() {
        return $this->belongsToMany(Student::class,'marks');
    }

    public function classRelation () {
        return $this->hasMany(ClassModel::class,'faculty_id','faculty_id');
    }

    public function marks() {
        return $this->hasMany(Mark::class,'subject_id','id');
    }
}
