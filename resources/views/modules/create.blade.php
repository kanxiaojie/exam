@extends('layout')

@section('content')
    <h4>新建模块</h4>
    <hr/>
    <form method="post" action="/modules" enctype="multipart/form-data">
        @include('modules.form', ['name' => old('name'), 'description' => old('description')])
    </form>
@stop