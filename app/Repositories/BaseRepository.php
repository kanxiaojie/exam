<?php
namespace App\Repositories;

use App\Course;
use App\CourseTime;
use App\Exam;
use App\Module;
use App\User;

class BaseRepository
{
    public function getByStudentId($student_id)
    {
        $user = User::where('student_id', $student_id)->first();

        return $user;
    }

    public function getByCourseId($id)
    {
        $course = Course::findOrFail($id);

        return $course;
    }

    public function getByCourseTimeId($id)
    {
        $courseTime = CourseTime::findOrFail($id);

        return $courseTime;
    }

    public function getByModuleId($id)
    {
        $module = Module::findOrFail($id);

        return $module;
    }

    public function getByExamId($id)
    {
        $exam = Exam::findOrFail($id);

        return $exam;
    }
}