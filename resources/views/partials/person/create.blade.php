@extends('layout')

@section('content')
    <h3>新建{{ $who }}信息</h3>
    <hr/>
    <form action="/{{ $uri }}" method="POST" enctype="multipart/form-data">
        @include('partials.person.form', ['student_id' => old('student_id'), 'name' => old('name')])
        <input type="hidden" name="password" value="{{ bcrypt('123456') }}">
    </form>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
@stop