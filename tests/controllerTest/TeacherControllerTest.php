<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeacherControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $password = '123456';
    protected $teacher;

    /** @before */
    public function setBeforeEveryClass()
    {
        $this->user = factory(App\User::class)->create([
            'student_id' => 'admin',
            'role_id'    => '3',
            'password'   => bcrypt($this->password)
        ]);

        $this->teacher = factory(App\User::class)->create([
            'student_id' => '2011012702',
            'role_id'    => '2',
            'name'       => 'Jack',
            'password'   => bcrypt($this->password)
        ]);
    }

    /**
     * @return $this
     * 管理员登录
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
     *test index() success
     */
    public function test_teacher_index_success()
    {
        $this->withoutMiddleware();

        $this->action('get', 'TeacherController@index');

        $this->assertResponseOk();
    }

    /**
     *test index() fail because of action type is post
     */
    public function test_teacher_index_fail()
    {
        $this->withoutMiddleware();

        $this->action('post', 'TeacherController@index');

        $this->assertResponseOk();
    }

    /**
     *没成功
     */
    public function test_teacher_create_success()
    {
        $this->withoutMiddleware();
//        $this->test_teacher_login();
        $this->action('get', 'TeacherController@create');

        $this->assertResponseOk();
    }
}