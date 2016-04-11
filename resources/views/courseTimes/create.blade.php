@extends('layout')

@section('content')
    <h4>课时创建</h4>
    <hr/>
    <form method="post" action="/courseTimes">
        @include('courseTimes.form', ['what' => '课时', 'name' => old('name'), 'description' => old('description'), 'moduleIds' => []])
    </form>
@stop