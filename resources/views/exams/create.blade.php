@extends('layout')

@section('content')
    <h4>创建考试</h4>
    <hr/>
    <form method="post" action="/exams">
        @include('courseTimes.form', ['what' => '考试', 'name' => old('name'), 'description' => old('description'), 'moduleIds' => []])
    </form>
@stop