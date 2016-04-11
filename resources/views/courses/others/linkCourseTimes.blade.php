@extends('layout')

@section('content')
    <h3>课程管理</h3>
    <hr/>

    <div class="page-container">
        @include('courses.panels.left-panels')

        @include('courses.others.linkCourseTimes_form', ['ifLinked' => '可关联', 'ifLink' => 'link', 'ifLinkCourseTimes' => $unCourseTimes, 'my_table' => 'my-table', 'checkButton' => 'unCheckUsersButton', 'check' => 'unCheckUsers', 'ifCheck' => 'checked', 'button_type' => 'button-primary', 'button_name' => '确认关联', 'moduleIds' => []])
        @include('courses.others.linkCourseTimes_form', ['ifLinked' => '已关联', 'ifLink' => 'unLink', 'ifLinkCourseTimes' => $courseTimes, 'my_table' => 'my-table2', 'checkButton' => 'checkUsersButton', 'check' => 'checkUsers', 'ifCheck' => '', 'button_type' => 'button-caution', 'button_name' => '取消关联'])

    </div>
@stop