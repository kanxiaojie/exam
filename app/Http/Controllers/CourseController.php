<?php

namespace App\Http\Controllers;

use App\Course;
use App\Repositories\BaseRepository;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    protected $base;

    public function __construct(BaseRepository $baseRepository)
    {
        $this->base = $baseRepository;

        parent::__construct();
    }

    public function index()
    {
        if(Auth::user()->role_id == 3)
        {
            $courses = Course::orderBy('name')->get();
        }else{
            $courses = Auth::user()->courses()->orderBy('name')->get();
        }

        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);

        return view('courses.show', compact('course', 'id'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        Course::create($request->all());

        return redirect('/courses');
    }

    public function edit($id)
    {
        $course = $this->base->getByCourseId($id);

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = $this->base->getByCourseId($id);
        $course->update($request->all());

        return redirect('/courses');
    }

    public function destroy($id)
    {
        $course = $this->base->getByCourseId($id);

        $course->delete();

        return redirect('/courses');
    }

}
