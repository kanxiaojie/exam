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
                                    <h3><span class="color">修改密码</span></h3>
                                    <hr/>
                                    <div class="form">
                                        <!-- Login form (not working)-->
                                        <form class="form-horizontal" method="POST" action="/changePassword/change">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="control-label col-md-3" for="password">密码</label>
                                                <div class="col-md-8">
                                                    <input type="password" class="form-control" id="password"
                                                           name="password" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3" for="password">确认密码</label>
                                                <div class="col-md-8">
                                                    <input type="password" class="form-control" id="password"
                                                           name="password_confirmation" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-info">确认</button>
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