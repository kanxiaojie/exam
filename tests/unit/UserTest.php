<?php

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     *测试用户数据不为null
     */
    public function test_user_is_or_not_null()
    {
        $this->assertNotEquals(null, User::where('student_id', 'admin')->get());
        $this->assertNotEquals(null, Role::where('id', 1)->get());
    }

    public function test_pagesController()
    {
        $this->visit('/')
            ->dontSee('Hello');
    }

    public function test_login()
    {
        $user = factory(App\User::class)->make();

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/')
            ->seePageIs('/');
    }
}

