<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class CourseTest extends TestCase
{
    use DatabaseTransactions;

    protected $course;
    protected $teacher;
    protected $password = '123456';

    /** @before */
    public function setBeforeEveryTest()
    {
        $this->teacher = factory(App\User::class)->create([
        'student_id' => '2010012701',
        'role_id'    => '2',
        'name'       => 'Mike',
        'password'   => bcrypt($this->password)
        ]);

        $this->course = factory(App\Course::class)->create([
            'name' => '大学语文',
            'description' => '学习汉语文化'
        ]);
    }

    /**
     * @return $this
     * 教师登录
     */
    public function test_teacher_login()
    {
        return $this->visit('/login')
            ->type($this->teacher->student_id, 'student_id')
            ->type('123456', 'password')
            ->press('登录')
            ->seePageIs('/')
            ;
    }

    /**
     *错误用户名无法登录
     */
    public function test_can_not_login_because_of_wrong_username()
    {
        $this->visit('/login')
            ->type('Invalid-username', 'student_id')
            ->type('123456', 'password')
            ->press('登录')
            ->see('These credentials do not match our records.')
        ;
    }

    /**
     *错误密码登录
     */
    public function test_can_not_login_because_of_wrong_password()
    {
        $this->visit('/login')
            ->type($this->teacher->student_id, 'student_id')
            ->type('Invalid-password', 'password')
            ->press('登录')
            ->see('These credentials do not match our records.')
        ;
    }

    /**
     *教师登录课程管理界面
     */
    public function test_a_teacher_can_visit_course_page()
    {
        $this->test_teacher_login();

        $this->see('课程管理')
            ->click('课程管理')
            ->seePageIs('/courses')
        ;
    }

    /**
     *教师成功添加课程
     */
    public function test_a_teacher_can_add_courses()
    {
        $this->test_teacher_login();

        $this->click('课程管理')
            ->seePageIs('/courses')
            ->click('添加新课程')
            ->seePageIs('/courses/create')
            ->type('大学语文', 'name')
            ->type('学习汉语言文化', 'description')
            ->press('确定')
            ->seePageIs('/courses')
        ;
    }

    /**
     *缺失课程名称无法添加课程
     */
    public function test_a_teacher_can_not_add_courses_because_of_no_name()
    {
        $this->test_teacher_login();

        $this->visit('/courses/create')
            ->see('确定')
            ->type('学习汉语言文化', 'description')
            ->press('确定')
//            ->seePageIs('/courses')
        ;
    }

    /**
     *缺失课程描述无法添加课程
     */
    public function test_a_teacher_can_not_add_courses_because_of_no_description()
    {
        $this->test_teacher_login();

        $this->visit('/courses/create')
            ->see('确定')
            ->type('大学语文', 'name')
            ->press('确定')//click('取消')响应的是最靠近的访问路由
            ->seePageIs('/courses')
        ;
    }

    /**
     *可查看添加的课程
     */
    public function test_teacher_can_see_what_course_he_add()
    {
        $this->seeInDatabase('courses',
            [
                'name' => '大学英语',
                'description' => '学习基础语法'
            ]);
    }

    /**
     *测试删除功能
     */
    public function test_teacher_can_see_exact_info_what_he_add()
    {
        $this->test_teacher_login();

        $this->visit('/courses')
            ->see('预览')
            ->click('预览')
            ->seePageIs('/courses/1')
            ->press('删除')
            ->seePageIs('/courses')
        ;
    }

    /**
     * 教师可以查看课程管理平台
     */
    public function test_teacher_can_see_course_management()
    {
        $this->test_teacher_login();

        $this->visit('/courses')
            ->see('管理')
            ->click('管理')
//            ->seePageIs('/courses/'.$this->course->id.'/edit')//无法判别点击哪一个链接，默认course->id=1
            ->seePageIs('/courses/1/edit')
            ->see('课程更新')
            ->see('成绩查询')
        ;
    }

    /**
     *教师可管理课程
     */
    public function test_a_teacher_can_operate_management_of_student()
    {
        $this->test_teacher_login();

        $this->visit('/courses/'.$this->course->id.'/edit')
             ->see('关联学生')
             ->click('关联学生')
             ->seePageIs('/courses/'.$this->course->id.'/linkStudents')
             ->press('确认关联')
             ->seePageIs('/courses/'.$this->course->id.'/linkStudents')
        ;

        $this->press('取消关联')
             ->seePageIs('/courses/'.$this->course->id.'/linkStudents')
        ;
    }
}