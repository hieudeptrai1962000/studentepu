<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{

    protected $fillable = ['name'];

    public function classRelations() {
        return $this->hasMany(ClassModel::class,'faculty_id','id');
    }
}
