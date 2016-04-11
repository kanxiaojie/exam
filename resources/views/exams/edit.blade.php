@extends('layout')

@section('content')
    <h4>更新考试信息</h4>
    <hr/>
    <form method="post" action="/exams/{{ $exam->id }}">
        <input type="hidden" name="_method" value="PUT">
        @include('courseTimes.form', ['what' => '考试', 'name' => $exam->name, 'description' => $exam->description])
    </form>
@stop