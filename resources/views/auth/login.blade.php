@extends('layout')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!-- Login starts -->

                    <div class="logreg">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="logreg-page">
                                    <h3>登录到 <span class="color">管理中心</span></h3>
                                    <hr/>
                                    <div class="form">
                                        <!-- Login form (not working)-->
                                        <form class="form-horizontal" method="POST" action="{{ url('/login') }}">
                                            <!-- Username -->
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="control-label col-md-3" for="student_id">学号</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="student_id"
                                                           name="student_id" value="{{ old('student_id') }}" required>
                                                </div>
                                            </div>
                                            <!-- Password -->
                                            <div class="form-group">
                                                <label class="control-label col-md-3" for="password">密码</label>
                                                <div class="col-md-8">
                                                    <input type="password" class="form-control" id="password"
                                                           name="password" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-9 col-md-offset-3">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="remember"> 记住我
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Buttons -->
                                            <div class="form-group">
                                                <!-- Buttons -->
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-info">登录</button>
                                                    <button type="reset" class="btn btn-default">重置</button>
                                                </div>
                                            </div>
                                        </form>
                                        @if(count($errors) > 0)
                                            <div class="alert alert-danger">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
