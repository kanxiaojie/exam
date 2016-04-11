@extends('layout')

@section('content')
    <h3>考试管理</h3>
    <hr/>
    <div class="text-right" style="margin-bottom: 20px">
        <a href="/exams/create" class="button button-rounded button-border button-primary">添加新考试</a>
    </div>

    <table id="my-table" class="table table-bordered text-center">
        <thead class="dynatable-active-page">
        <tr>
            <th>考试名称</th>
            <th>考试描述</th>
            <th>相关模块</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($exams as $exam)
            <tr>
                <td>{{ $exam->name }}</td>
                <td>{{ $exam->description }}</td>
                <td>
                    @foreach($exam->modules()->orderBy('name')->get() as $module)
                        {{ $module->name }}&nbsp;&nbsp;
                    @endforeach
                </td>
                <td>
                    <form class="form-horizontal" method="post"
                          action="/exams/{{ $exam->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">

                        <a href="/exams/{{ $exam->id }}/edit" class="btn btn-info">编辑</a>
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop