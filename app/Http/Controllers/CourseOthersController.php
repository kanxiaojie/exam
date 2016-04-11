<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

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

    public function studentsLink(Request $request, $id)
    {
        $course = $this->base->getByCourseId($id);
        $inputs = $request->input('person');

        if(!$inputs == null)
        {
            $userId = [];

            foreach($inputs as $input)
            {
                $userUnLink = User::findOrFail($input);
                $studentIds = User::lists('student_id')->toArray();//所有的ID

                if(!in_array($userUnLink->student_id, $studentIds))
                {
                    $user = new User();
                    $user->student_id = $userUnLink->student_id;
                    $user->name = $userUnLink->name;
                    $user->role_id = 1;
                    $user->password = bcrypt('123456');
                    $user->save();
                    $userId[] = $user->id;
                }else{
                    $userId[] = User::where('student_id', $userUnLink->student_id)->first()->id;
                }
            }

            $course->users()->attach($userId);
            flash()->success('恭喜! ', '关联成功');
        }

        return back();
    }

    public function studentsUnLink(Request $request, $id)
    {
        $course = $this->base->getByCourseId($id);
        $inputs = $request->input('person');

        if(! $inputs == null)
        {
            foreach($inputs as $input)
            {
                $userLink = User::findOrFail($input);//取得对应的人
                $userLink->delete();//删除对应的人
            }
            $course->users()->attach($inputs);
            flash()->success('恭喜！', '取消关联成功！');
        }

        return back();
    }

    public function courseTimes($id)
    {
        $course = $this->base->getByCourseId($id);
        $Ids = $course->courseTimes->lists('id');
        $unCourseTimes = Auth::user()->courseTime()->whereNotIn('id', $Ids)->orderBy('name')->get();
        $courseTimes = $course->courseTimes()->orderBy('name')->get();

        return view('courses.others.linkCourseTimes', compact('unCourseTimes', 'courseTimes', 'course', 'id'));
    }

//    public function delete($id)
//    {
//        $course = $this->base->getByCourseId($id);
//
//        return view('courses.others.delete', compact('course'));
//    }
}
