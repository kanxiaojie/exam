@extends('layout')

@section('content')
    <div class="container">
        <h3>管理课程</h3>
        <hr/>
        <div id="page-container">

            @include('courses.panels.left-panels')

            <div class="mainpanel">
                <div class="contentpanel">
                    <div class="panel-body">
                        <form method="post" action="/courses/{{ $course->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            @include('courses.form', ['name' => $course->name, 'description' => $course->description])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop