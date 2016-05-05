<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id','role_id','name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne('App\Role');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'courseUser');
    }

    public function courseTime()
    {
        return $this->hasMany('App\CourseTime');
    }

    public function module()
    {
        return $this->hasMany('App\Module');
    }

    public function exam()
    {
        return $this->hasMany('App\Exam');
    }
}
