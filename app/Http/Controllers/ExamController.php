<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
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
            $exams = Exam::orderBy('name')->get();
        }else{
            $exams = Exam::where('user_id', Auth::user()->id)->orderBy('name')->get();
        }

        return view('exams.index', compact('exams'));
    }

    public function create()
    {
        return view('exams.create');
    }

    public function store(Request $request)
    {
        $exams = Exam::create($request->all());
        $exams->modules()->attach($request->input('modules'));

        return redirect('/exams');
    }

    public function edit($id)
    {
        $exam = $this->base->getByExamId($id);
        $moduleIds = $exam->modules->lists('id')->toArray();

        return view('exams.edit', compact('exam', 'moduleIds'));
    }

    public function update(Request $request, $id)
    {
        $exam = $this->base->getByExamId($id);
        $exam->modules()->detach();
        $exam->modules()->attach($request->input('modules'));
        $exam->update($request->all());

        return redirect('/exams');
    }

    public function destroy($id)
    {
        $exam = $this->base->getByExamId($id);
        $exam->modules()->detach();
        $exam->courses()->detach();
        $exam->delete();

        return back();
    }
}
