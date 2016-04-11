@extends('layout')

@section('content')
    <h4>更新课时信息</h4>
    <hr/>
    <form method="post" action="/courseTimes/{{ $courseTime->id }}">
        <input type="hidden" name="_method" value="PUT">
        @include('courseTimes.form', ['what' => '课时', 'name' => $courseTime->name, 'description' => $courseTime->description])
    </form>
@stop