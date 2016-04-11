<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'courseUser');
    }

    public function courseTimes()
    {
        return $this->hasMany('App\CourseTime', 'courseCourseTime');
    }

    public function exams()
    {
        return $this->hasMany('App\Exam', 'courseExams');
    }
}
