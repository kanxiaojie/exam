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
        return $this->belongsToMany('App\CourseTime', 'CourseCourseTime', 'course_id', 'course_time_id');
    }

    public function exams()
    {
        return $this->belongsToMany('App\Exam', 'courseExams');
    }
}
