<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $password = '123456';

    /** @before */
    public function setUpUserObjectBeforeAnyTest()
    {
        $this->user = factory(App\User::class)->create([
           'student_id' => 'admin',
            'password' => bcrypt($this->password),
        ]);
    }

    /**
     *测试用户成功登录界面
     */
    public function test_a_user_can_successfully_login()
    {
        $this->visit('/login');
        $this->type($this->user->student_id, 'student_id');
        $this->type('123456', 'password');
        $this->press('登录');
        $this->seePageIs('/');
    }

    /**
     *密码填写错误无法登录
     */
    public function test_a_user_login_failed_because_of_wrong_password()
    {
        $this->visit('/login');
        $this->type($this->user->student_id, 'student_id');
        $this->type('Invalid-password', 'password');
        $this->press('登录');
        $this->see('These credentials do not match our records.');
    }

    /**
     *用户名填写错误无法登录
     */
    public function test_a_user_login_failed_because_of_wrong_username()
    {
        $this->visit('/login')
            ->type('Invalid-username', 'student_id')
            ->type('123456', 'password')
            ->press('登录')
            ->seePageIs('/login')
        ;
    }

    /**
     *测试成功登录后跳转的页面
     */
    public function test_login_successfully_and_redirect_page_is()
    {
        $this->actingAs($this->user);

        $this->visit('/login')
            ->seePageIs('/')
        ;
    }

    /**
     *测试退出
     */
    public function test_logout_successfully()
    {
        $this->actingAs($this->user);

        $this->visit('/')
            ->click('登出')
            ->seePageIs('/login')
        ;
    }

}