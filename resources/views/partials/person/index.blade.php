@extends('layout')

@section('content')
    <h3>{{ $who }}管理</h3>
    <hr/>
    <div class="text-right" style="margin-bottom: 20px">
        <a class="button button-rounded button-border button-primary" href="/{{ $uri }}/create">添加新{{ $who }}</a>
    </div>

    <table id="my-table" class="table table-bordered text-center">
        <thead class="dynatable-active-page">
            <tr>
                <th>{{ $whoseId }}</th>
                <th>{{ $who }}姓名</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($people as $person)
                <tr>
                    <td>{{ $person->student_id }}</td>
                    <td>{{ $person->name }}</td>
                    <td>{{ $person->created_at }}</td>
                    <td>
                        <form class="form-horizontal" method="POST"
                              action="/{{ $uri }}/{{ $person->student_id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">

                            <a class="btn btn-info" href="/{{ $uri }}/{{ $person->student_id }}/edit">编辑</a>
                            <button type="submit" class="btn btn-danger">删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop