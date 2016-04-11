<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'student_id' => 'admin',
            'name'       => '管理员',
            'role_id'    => '3',
            'password'   => bcrypt('123456')
        ]);
    }
}
