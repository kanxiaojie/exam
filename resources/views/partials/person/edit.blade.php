@extends('layout')

@section('content')
    <h3>更新{{ $who }}信息</h3>
    <hr/>

    <form method="post" action="/{{ $uri }}/{{ $person->student_id }}">
        <input type="hidden" name="_method" value="PUT">
        @include('partials.person.form', ['student_id' => $person->student_id, 'name' => $person->name])
    </form>

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
@stop