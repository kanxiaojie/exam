<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StudentRequest;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;

class StudentController extends Controller
{
    public $base;

    public function __construct(BaseRepository $baseRepository)
    {
        $this->base = $baseRepository;

        parent::__construct();
    }

    public function index()
    {
        $students = User::where('role_id', '1')->orderBy('student_id')->get();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(StudentRequest $request)
    {
        User::create($request->all());

        return redirect('/students');
    }

    public function edit($student_id)
    {
        $student = $this->base->getByStudentId($student_id);

        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $student_id)
    {
        $student = $this->base->getByStudentId($student_id);
        $student->update($request->all());

        return redirect('/students');
    }

    public function destroy($student_id)
    {
        $student = $this->base->getByStudentId($student_id);
        $student->courses()->detach();
        $student->delete();

        return back();
    }
}
