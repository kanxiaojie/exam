<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * 测试管理员对学生的管理
 */
class StudentTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $password = '123456';
    protected $student;

    /** @before */
    public function setBeforeEveryClass()
    {
        $this->user = factory(App\User::class)->create([
            'student_id' => 'admin',
            'role_id'    => '3',
            'password'   => bcrypt($this->password)
        ]);

        $this->student = factory(App\User::class)->create([
            'student_id' => '2011012700',
            'role_id'    => '1',
            'name'       => 'Jack',
            'password'   => bcrypt($this->password)
        ]);
    }

    /**
     * @return $this
     * 管理员登录
     */
    public function test_admin_login()
    {
        return $this->visit('/login')
                    ->type($this->user->student_id, 'student_id')
                    ->type('123456', 'password')
                    ->press('登录')
                    ->seePageIs('/')
        ;
    }

    /**
     * 不是以管理员身份登录,比如以学生身份登录
     */
    public function test_not_admin_login()
    {
        return $this->visit('/login')
                    ->type($this->student->student_id, 'student_id')
                    ->type('123456', 'password')
                    ->press('登录')
                    ->seePageIs('/')
            ;
    }

    /**
     *管理员可以访问学生界面
     */
    public function test_admin_can_visit_student_page()
    {
        $this->test_admin_login();

        $this->see('学生管理')
            ->visit('/students')
            ->seePageIs('/students')
        ;
    }

    /**
     *查看添加的学生信息
     */
    public function test_if_user_is_admin_can_see_student_exact_info()
    {
        $this->test_admin_login();

        $this->visit('/teachers');

        $this->assertEquals('2011012700', $this->student->student_id);
        $this->assertEquals('Jack', $this->student->name);
    }

    /**
     * 不是以管理员身份登录则无法查看相应视图
     */
    public function test_if_not_a_admin_or_can_not_see_some_views()
    {
        $this->test_admin_login();

        $this->dontSee('学生管理')
             ->dontSee('教师管理')
             ->dontSee('课程管理')
             ->dontSee('课时管理')
             ->dontSee('模块管理')
             ->dontSee('考试管理')
//            ->dontSee('查看课程')
        ;
    }

    /**
     *以管理员身份登录时，可以添加学生
     */
    public function test_when_admin_login_can_add_students()
    {
        $this->test_admin_login();

        $this->see('学生管理')
            ->click('学生管理')
            ->seePageIs('/students')
            ->click('添加新学生')
            ->seePageIs('/students/create')
            ->type('2011012700', 'student_id')
            ->type('Jack', 'name')
            ->press('确定')
            ->seePageIs('/students')
        ;
    }

    /**
     *缺失学生姓名信息时，则无法创建学生
     */
    public function test_admin_can_not_add_student_because_of_no_name()
    {
        $this->test_admin_login();

        $this->visit('/students/create')
            ->see('确定')
            ->type('2011012700', 'student_id')
            ->press('确定')
            ->seePageIs('/students')//此处会得到一个错误提示, 即看到的界面仍然是创建页面，因为缺少填写的信息
        ;
    }

    /**
     *缺失学生学号信息时，则无法创建学生
     */
    public function test_admin_can_not_add_student_because_of_no_studentId()
    {
        $this->test_admin_login();

        $this->visit('/students/create')
            ->see('确定')
            ->type('Jack', 'name')
            ->press('确定')
            ->seePageIs('/students')//此处会得到一个错误提示, 即看到的界面仍然是创建页面，因为缺少填写的信息
        ;
    }

    /**
     *管理员可以修改学生信息
     */
    public function test_admin_can_edit_student_info()
    {
        $this->test_admin_login();

        $this->visit('/students')
            ->see('编辑')
            ->click('编辑')
            ->seePageIs('/students/'.$this->student->student_id.'/edit')
        ;

        $this->type('2011012701', 'student_id')
            ->type('张三', 'name')
            ->press('确定')
            ->seePageIs('/students')
        ;
    }

    /**
     *管理员可以删除学生
     */
    public function test_admin_can_delete_students()
    {
        $this->test_admin_login();

        $this->visit('/students')
            ->see('删除')
            ->press('删除')
            ->seePageIs('/students')
        ;
    }

    /**
     *登录人员才可以看到相关标题栏内容
     */
    public function test_when_login_admin_can_see_student_title()
    {
        $this->test_admin_login();

        $this->visit('/students')
            ->see('学号')
            ->see('学生姓名')
            ->see('创建时间')
            ->see('操作')
        ;
    }
}