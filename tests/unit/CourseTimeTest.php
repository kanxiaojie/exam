<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class CourseTimeTest extends TestCase
{
    use DatabaseTransactions;

    protected $courseTime;
    protected $module;
    protected $name;
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

        $this->courseTime = factory(App\CourseTime::class)->create([
            'id' => 27,
            'name' => '第六章',
            'description' => '英国'
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
     *添加课时
     */
    public function test_a_teacher_can_add_courseTimes()
    {
        $this->test_teacher_login();

        $this->visit('/courseTimes')
            ->click('添加新课时')
            ->seePageIs('/courseTimes/create')
            ->type('第六章', 'name')
            ->type('英国史', 'description')
//            ->type('英语角', $this->module->name)
            ->press('确定')
            ->seePageIs('/courseTimes')
        ;
    }

    /**
     *编辑课时
     */
    public function test_a_teacher_can_edit_a_courseTime()
    {
        $this->test_teacher_login();

        $this->visit('/courseTimes')
            ->click('编辑')
            ->seePageIs('/courseTimes/26/edit')
        ;
    }

    /**
     *删除课时
     */
    public function test_a_teacher_can_delete_courseTimes()
    {
        $this->test_teacher_login();

        $this->visit('/courseTimes')
            ->press('删除')
            ->seePageIs('/courseTimes')
        ;
    }
}