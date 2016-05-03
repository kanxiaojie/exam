<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExamTest extends TestCase
{
    use DatabaseTransactions;

    protected $exam;
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

        $this->exam = factory(App\Exam::class)->create([
            'id' => 6,
            'name' => '期中测试',
            'description' => '检测学习情况'
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
     *增加考试
     */
    public function test_a_teacher_can_add_exams()
    {
        $this->test_teacher_login();

        $this->visit('/exams')
            ->click('添加新考试')
            ->seePageIs('/exams/create')
            ->type('期末测试', 'name')
            ->type('检测学习情况', 'description')
            ->type(12, 'user_id')
            ->press('确定')
            ->seePageIs('/exams')
        ;
    }

    /**
     *编辑考试
     */
    public function test_a_teacher_can_edit_exams()
    {
        $this->test_teacher_login();

        $this->visit('/exams')
            ->click('编辑')
            ->seePageIs('/exams/1/edit')
            ->type('期中测试', 'name')
            ->press('确定')
            ->seePageIs('/exams')
        ;
    }

    /**
     *删除考试
     */
    public function test_a_teacher_can_delete_exams()
    {
        $this->test_teacher_login();

        $this->visit('/exams')
            ->press('删除')
            ->seePageIs('/exams')
        ;
    }
}