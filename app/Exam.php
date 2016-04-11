<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
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
        return $this->belongsToMany('App\Course', 'courseExams');
    }

    public function modules()
    {
        return $this->belongsToMany('App\Exam', 'examModule');
    }
}
