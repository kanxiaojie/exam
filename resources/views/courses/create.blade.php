@extends('layout')

@section('content')
    <h4>新建课程</h4>
    <hr/>
    <form method="post" action="/courses" enctype="multipart/form-data">
        @include('partials.others.form_content', ['name' => old('name'), 'description'=> old('description'),'what' => '课程'])
        @include('partials.others.form_button')
    </form>
@stop