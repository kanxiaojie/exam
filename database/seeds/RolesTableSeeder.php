<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id'   => '1',
            'name' => '学生'
        ]);
        Role::create([
            'id'   => '2',
            'name' => '老师'
        ]);
        Role::create([
            'id'   => '3',
            'name' => '管理员'
        ]);
    }
}
