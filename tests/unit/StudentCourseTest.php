<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class StudentCourseTest extends TestCase
{
    use DatabaseTransactions;

    protected $student;
    protected $password = '123456';

    /** @before */
    public function setBeforeVeryTest()
    {
        $this->student = factory(App\User::class)->create([
            'student_id' => '2011012701',
            'role_id'    => '1',
            'name'       => 'Mike',
            'password'   => bcrypt($this->password)
        ]);
    }

    /**
     *学生登录
     */
    public function test_student_can_login()
    {
        return $this->visit('/login')
            ->type($this->student->student_id, 'student_id')
            ->type('123456', 'password')
            ->press('登录')
            ->seePageIs('/')
            ;
    }

    public function test_students_can_view_courses()
    {
        $this->test_student_can_login();

        $this->visit('/studentsCourses')

        ;
    }
}