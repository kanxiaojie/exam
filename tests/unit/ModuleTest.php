<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ModuleTest extends TestCase
{
    use DatabaseTransactions;

    protected $module;
    protected $teacher;
    protected $password = '123456';

    /** @before */
    public function setBeforeEveryTest()
    {
        $this->teacher = factory(App\User::class)->create([
            'student_id' => '2010012700',
            'role_id'    => '2',
            'name'       => 'Mike',
            'password'   => bcrypt($this->password)
        ]);

        $this->module = factory(App\Module::class)->create([
            'id' => 2,
            'name' => '汉语角',
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
     *教师添加模块
     */
    public function test_a_teacher_can_add_modules()
    {
        $this->test_teacher_login();

        $this->visit('/modules')
            ->click('添加新模块')
            ->seePageIs('/modules/create')
            ->type('汉语广场', 'name')
            ->type('学习汉语口语', 'description')
            ->press('确定')
            ->seePageIs('/modules')
        ;
    }

    /**
     *教师可以编辑模块
     */
    public function test_a_teacher_can_edit_modules()
    {
        $this->test_teacher_login();

        $this->visit('/modules')
            ->click('编辑')
            ->seePageIs('/modules/'.$this->module->id.'/edit')
        ;
    }

    /**
     *删除模块
     */
    public function test_a_teacher_can_delete_modules()
    {
        $this->test_teacher_login();

        $this->visit('/modules')
            ->see('删除')
            ->press('删除')
            ->seePageIs('/modules')
        ;
    }
}