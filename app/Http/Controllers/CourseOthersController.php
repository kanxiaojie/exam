<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class CourseOthersController extends Controller
{
    protected $base;

    public function __construct(BaseRepository $baseRepository)
    {
        $this->base = $baseRepository;

        parent::__construct();
    }

    public function students($id)
    {
        $course = $this->base->getByCourseId($id);
        $studentIds = $course->users()->where('role_id', 1)->get()->lists('student_id');//已经关联的学生数
        $unStudents = User::where('role_id', 1)->whereNotIn('student_id', $studentIds)->orderBy('student_id')->get();//未关联的学生
        $students = $course->users()->where('role_id', 1)->orderBy('student_id')->get();//已相关的学生

        return view('courses.others.linkStudents', compact('course', 'unStudents', 'students', 'id'));
    }

//    public function delete($id)
//    {
//        $course = $this->base->getByCourseId($id);
//
//        return view('courses.others.delete', compact('course'));
//    }
}
