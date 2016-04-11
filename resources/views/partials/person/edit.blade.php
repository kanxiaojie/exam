@extends('layout')

@section('content')
    <h3>更新{{ $who }}信息</h3>
    <hr/>

    <form method="post" action="/{{ $uri }}/{{ $person->student_id }}">
        <input type="hidden" name="_method" value="PUT">
        @include('partials.person.form', ['student_id' => $person->student_id, 'name' => $person->name])
    </form>
@stop