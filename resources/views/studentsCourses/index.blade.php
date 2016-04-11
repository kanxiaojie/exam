@extends('layout')

@section('content')
    <h3>课程管理</h3>
    <hr/>

    <table id="my-table" class="table table-bordered text-center">
        <thead class="dynatable-active-page">
        <tr>
            <th>课程名称</th>
            <th>课程描述</th>
            <th>课时数</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ count($course->courseTimes)}}</td>
                <td>
                    <a class="btn btn-primary" href="">预览</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop