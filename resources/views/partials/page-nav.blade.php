<div class="navbar bs-docs-nav navbar-fixed-top" role="banner">

    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                @if($signedIn)
                    @can('admin', Auth::user())
                        <li id="teachersNav"><a href="/teachers">教师管理</a></li>
                        <li id="studentsNav"><a href="/students">学生管理</a></li>
                    @endcan

                    @can('teacher', Auth::user())
                        <li id="coursesNav"><a href="/courses">课程管理</a></li>
                        <li id="courseTimesNav"><a href="/courseTimes">课时管理</a></li>
                        <li id="modulesNav"><a href="/modules">模块管理</a></li>
                        <li id="examsNav"><a href="/exams">考试管理</a></li>
                    @endcan

                    @can('student', Auth::user())
                        <li id="studentCoursesNav"><a href="/studentsCourses">查看课程</a></li>
                    @endcan
                @endif
            </ul>

            <ul class="nav navbar-nav pull-right">
                @if(!$signedIn)
                    <li id="loginNav"><a href="/login">登录</a></li>
                @endif

                @if($signedIn)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"
                           data-toggle="dropdown">
                            {{ $user->name }}
                            <b class="caret"></b>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="/changePassword">修改密码</a></li>
                            <li><a href="/logout">登出</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>