<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    public function index()
    {
        $courses = Auth::user()->courses()->get();

        return view('studentsCourses.index', compact('courses'));
    }
}
