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
        return $this->belongsToMany('App\User');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'courseCourseTime');
    }

    public function modules()
    {
        return $this->belongsToMany('App\Module', 'moduleCourseTime');
    }
}
