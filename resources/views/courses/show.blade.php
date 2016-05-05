@extends('layout')

@section('content')
    <h3 class="text-center">课程信息</h3>
    <hr>
    <div id="page-container" style="padding-right: 200px">
        <div class="mainpanel">
            <div class="contentpanel">
                <div class="panel-body">

                    <div class="form-group">
                        <div class="row">
                            <h3 class="col-md-4 text-right">课程名称:</h3>
                            <h3 class="col-md-4">{{ $course->name }}</h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <h3 class="col-md-4 text-right">课程描述:</h3>
                            <h3 class="col-md-4">{{ $course->description }}</h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <h3 class="col-md-4 text-right">创建人:</h3>
{{--                            <h3 class="col-md-4">{{ $user->name }}</h3>--}}
                            <h3 class="col-md-4">
                                {{--@foreach($course->users()->where('role_id',2)->get() as $user)--}}
                                    {{--{{ $user->name }}--}}
                                {{--@endforeach--}}
                            </h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <h3 class="col-md-4 text-right">创建时间:</h3>
                            <h3 class="col-md-4">{{ $course->created_at }}</h3>
                        </div>
                    </div>

                    <form action="/courses/{{ $course->id }}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        {{ csrf_field() }}

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-danger btn-q">删除</button>
                            <a onclick="javascript:window.location.href=history.back()" class="btn btn-default btn-q">
                                取消 </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

