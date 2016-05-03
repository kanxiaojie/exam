<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DatabaseTest extends TestCase
{
    public function test_database_users()
    {
        $this->seeInDatabase('users', ['student_id' => 'admin']);
    }

    public function test_database_roles()
    {
        $this->seeInDatabase('roles', ['name' => '学生']);
    }

    public function test_database_courses()
    {
        $this->seeInDatabase('courses', ['name' => '大学英语']);
    }
}
