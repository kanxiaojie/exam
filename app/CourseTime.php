<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseTime extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'CourseCourseTime', 'course_id', 'course_times_id');
    }

    public function modules()
    {
        return $this->belongsToMany('App\Module', 'moduleCourseTime');
    }
}
