@extends('layout')

@section('content')
    <h3>课时管理</h3>
    <hr/>
    <div class="text-right" style="margin-bottom: 20px">
        <a href="/courseTimes/create" class="button button-rounded button-border button-primary">添加新课时</a>
    </div>

    <table id="my-table" class="table table-bordered text-center">
        <thead class="dynatable-active-page">
            <tr>
                <th>课时名称</th>
                <th>课时描述</th>
                <th>相关模块</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courseTimes as $courseTime)
                <tr>
                    <td>{{ $courseTime->name }}</td>
                    <td>{{ $courseTime->description }}</td>
                    <td>
                        @foreach($courseTime->modules()->orderBy('name')->get() as $module)
                            {{ $module->name }}&nbsp;&nbsp;
                        @endforeach
                    </td>
                    <td>
                        <form class="form-horizontal" method="post"
                              action="/courseTimes/{{ $courseTime->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">

                            <a href="/courseTimes/{{ $courseTime->id }}/edit" class="btn btn-info">编辑</a>
                            <button type="submit" class="btn btn-danger">删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop