<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\TeacherRequest;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;

class TeacherController extends Controller
{
    protected $base;

    public function __construct(BaseRepository $baseRepository)
    {
        $this->base = $baseRepository;

        parent::__construct();
    }

    public function index()
    {
        $teachers = User::where('role_id', 2)->orderBy('student_id')->get();

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(TeacherRequest $request)
    {
        User::create($request->all());

        return redirect('/teachers');
    }

    public function edit($student_id)
    {
        $teacher = $this->base->getByStudentId($student_id);

        return view('teachers.edit', compact('teacher'));
    }

    public function update(TeacherRequest $request, $student_id)
    {
        $teacher = $this->base->getByStudentId($student_id);
        $teacher->update($request->all());

        return redirect('/teachers');
    }

    public function destroy($student_id)
    {
        $teacher = $this->base->getByStudentId($student_id);
        $teacher->courses()->detach();
        $teacher->delete();

        return back();
    }
}
