@extends('layout')

@section('content')
    <h3>课程管理</h3>
    <hr/>

    <div class="page-container">
        @include('courses.panels.left-panels')

        @include('courses.others.linkPeople_Form', ['action' => 'linkStudents', 'whoseId' => '学生学号', 'whoseName' => '学生姓名', 'ifLinked' => '可关联', 'ifLink' => 'link', 'ifLinkPeople' => $unStudents,'my_table' => 'my-table', 'checkButton' => 'unCheckUsersButton', 'check' => 'unCheckUsers', 'ifCheck' => 'checked', 'button_type' => 'button-primary', 'button_name' => '确认关联'])

        @include('courses.others.linkPeople_Form', ['action' => 'linkStudents', 'whoseId' => '学生学号', 'whoseName' => '学生姓名', 'ifLinked' => '已关联', 'ifLink' => 'unLink', 'ifLinkPeople' => $students,'my_table' => 'my-table2', 'checkButton' => 'CheckUsersButton', 'check' => 'CheckUsers', 'ifCheck' => '', 'button_type' => 'button-caution', 'button_name' => '取消关联'])
    </div>
@stop