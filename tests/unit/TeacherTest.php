<?php

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\Concerns\InteractsWithPages;

/**
 * 测试管理员对教师的管理
 */
class TeacherTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $password = '123456';
    protected $teacher;

    /** @before */
    public function setBeforeEveryTest()
    {
        $this->user = factory(App\User::class)->create([
            'student_id' => 'admin',
            'role_id'    => '3',
            'password'   => bcrypt($this->password)
        ]);

        $this->teacher = factory(App\User::class)->create([
            'student_id' => '2010012708',
            'role_id'    => '2',
            'name'       => 'Lucy',
            'password'   => bcrypt($this->password)
        ]);
    }

    /**
     *测试管理员登录后可以进入创建教师界面
     */
    public function test_admin_could_see_the_teacher_info()
    {
        $this->visit('/login');
        $this->type($this->user->student_id, 'student_id');
        $this->type('123456', 'password');
        $this->press('登录');
        $this->seePageIs('/');

        $this->see('教师管理')
             ->click('教师管理')
             ->seePageIs('/teachers')
             ->click('添加新教师')
             ->seePageIs('/teachers/create')
        ;
    }

    /**
     *查看添加的老师信息
     */
    public function test_if_user_is_admin_can_see_teacher_exact_info()
    {
        $this->visit('/login');
        $this->type($this->user->student_id, 'student_id');
        $this->type('123456', 'password');
        $this->press('登录');
        $this->seePageIs('/');

        $this->visit('/teachers');

        $this->assertEquals('2010012708', $this->teacher->student_id);
        $this->assertEquals('Lucy', $this->teacher->name);
    }

    /**
     *未以管理员身份登录时则无法看到相应视图
     */
    public function test_if_not_a_admin_or_cannot_see_teacher_info()
    {
        $this->visit('/login')
            ->type($this->teacher->student_id, 'student_id')
            ->type('123456', 'password')
            ->press('登录')
            ->seePageIs('/')
            ->dontSee('教师管理')
            ->dontSee('学生管理')
        ;
    }

    /**
     *测试admin可以添加教师
     */
    public function test_admin_could_add_teachers()
    {
        $this->visit('/login');
        $this->type($this->user->student_id, 'student_id');
        $this->type('123456', 'password');
        $this->press('登录');
        $this->seePageIs('/');

        $this->visit('/teachers/create')
            ->see('确定')
            ->type('2010012700', 'student_id')
            ->type('Jack', 'name')
            ->press('确定')
            ->seePageIs('/teachers')
        ;
    }

    /**
     *不填写教师工号，管理员则无法创建教师（不填写姓名相同）
     * 还可以写出学号如果一样抛出的错误
     */
    public function test_admin_could_not_add_teachers_because_of_no_studentId()
    {
        $this->visit('/login');
        $this->type($this->user->student_id, 'student_id');
        $this->type('123456', 'password');
        $this->press('登录');
        $this->seePageIs('/');

        $this->visit('/teachers/create')
            ->see('确定')
            ->type('Jack', 'name')
            ->press('确定')
            ->see('The student id field is required.')
        ;
    }

    /**
     *测试管理员成功编辑教师信息
     *以此办法只能以第一条数据进行测试,不具备普遍性
     */
    public function test_admin_could_edit_teacher_info()
    {
        $this->teacher = factory(App\User::class)
            ->create([
                'student_id' => '2010012701',
                'name' => 'Mike'
            ]);

        $this->visit('/login');
        $this->type($this->user->student_id, 'student_id');
        $this->type('123456', 'password');
        $this->press('登录');
        $this->seePageIs('/');

        $this->visit('/teachers')
             ->see('编辑')
             ->click('编辑')
             ->seePageIs('/teachers/'.$this->teacher->student_id.'/edit')
        ;

        $this->type('2010012703', 'student_id')
             ->type('John', 'name')
             ->press('确定')
             ->seePageIs('/teachers')
        ;
    }

    /**
     *管理员可对教师进行删除操作
     */
    public function test_admin_can_delete_teachers()
    {
        $this->visit('/login');
        $this->type($this->user->student_id, 'student_id');
        $this->type('123456', 'password');
        $this->press('登录');
        $this->seePageIs('/');

        $this->visit('/teachers')
             ->see('删除')
             ->press('删除')
             ->seePageIs('/teachers')
        ;
    }

    /**
     *登录人员才可以看到相关标题栏内容
     */
    public function test_when_login_admin_can_see_teachers_title()
    {
        $this->visit('/login')
            ->type($this->user->student_id, 'student_id')
            ->type('123456', 'password')
            ->press('登录')
            ->seePageIs('/');

        $this->visit('/teachers')
            ->see('教师管理')
            ->see('教师工号')
            ->see('教师姓名')
            ->see('创建时间')
            ->see('操作')
        ;
    }





//    public function setUp()
//    {
//        parent::setUp();
//
//        Session::start();
//
//        $this->faker = Faker\Factory::create('en_EN');
//
//        $user = App\User::find(2);
//
//        $this->be($user);
//    }
//
//    public function test_click_teachers()
//    {
//        $user = factory(App\User::class)->make();
//
//        $this->actingAs($user)
//            ->withSession(['foo' => 'bar'])
//            ->visit('/teachers')
//            ->seePageIs('/');
//    }
//
//    public function test_login_and_click()
//    {
//
//        $this->withoutMiddleware();
//
//        $user = factory(App\User::class)->make();
//
//        $this->actingAs($user)
//             ->withSession(['student_id' => 'admin'])
//             ->visit('/')
//             ->seePageIs('/')
//             ->visit('/teachers')
//
//        ;
//    }
//
//    public function test_delete()
//    {
//        $this->withoutMiddleware();
//
//        $response = $this->call('DELETE', '/teachers/2', ['_token' => csrf_token()]);
//        $this->assertEquals(302, $response->getStatusCode());
//        $this->notSeeInDatabase('users', ['student_id' => null, 'id' => 2]);
//    }
//
//    public function test_delete2()
//    {
//        $this->withoutMiddleware();
//
//        $user = User::where('student_id', '2010012700')->get();
//
//        $this->action('DELETE', 'TeacherController@destroy', ['id' => 2]);
//
//        $this->delete('/teachers/destroy/2');
//
//    }
}