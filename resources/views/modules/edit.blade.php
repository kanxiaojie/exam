@extends('layout')

@section('content')
    <h4>更新模块信息</h4>
    <hr/>
    <form method="post" action="/modules/{{ $module->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @include('modules.form', ['name' => $module->name, 'description' => $module->description])
    </form>
@stop