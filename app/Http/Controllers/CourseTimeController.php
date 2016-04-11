<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseTime;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CourseTimeController extends Controller
{
    protected $base;

    public function __construct(BaseRepository $baseRepository)
    {
        $this->base = $baseRepository;

        parent::__construct();
    }

    public function index()
    {
        if(Auth::user()->role_id == 3){
            $courseTimes = CourseTime::orderBy('name')->get();
        }else{
            $courseTimes = CourseTime::where('user_id', Auth::user()->id)->orderBy('name')->get();
        }

        return view('courseTimes.index', compact('courseTimes'));
    }

    public function create()
    {
        return view('courseTimes.create');
    }

    public function store(Request $request)
    {
        $courseTimes = CourseTime::create($request->all());
        $courseTimes->modules()->attach($request->input('modules'));

        return redirect('/courseTimes');
    }

    public function edit($id)
    {
        $courseTime = $this->base->getByCourseTimeId($id);
        $moduleIds = $courseTime->modules->lists('id')->toArray();

        return view('courseTimes.edit', compact('courseTime', 'moduleIds'));
    }

    public function update(Request $request, $id)
    {
        $course = $this->base->getByCourseTimeId($id);
        $course->modules()->detach();
        $course->modules()->attach($request->input('modules'));
        $course->update($request->all());

        return redirect('/courseTimes');
    }

    public function destroy($id)
    {
        $courseTime = $this->base->getByCourseTimeId($id);
        $courseTime->courses()->detach();
        $courseTime->modules()->detach();
        $courseTime->delete();

        return back();
    }
}
