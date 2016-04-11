<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function courseTimes()
    {
        return $this->belongsToMany('App\CourseTime', 'moduleCourseTime');
    }

    public function exams()
    {
        return $this->belongsToMany('App\Exam', 'examModule');
    }
}
