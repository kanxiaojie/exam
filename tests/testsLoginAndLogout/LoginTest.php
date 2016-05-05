<?php

class LoginTest extends TestCase
{
    public function test_login()
    {
        $user = factory('App\User')->make([
            'name' => 'Ali',
        ]);

        $this->actingAs($user)
             ->withSession(['foo' => 'bar'])
             ->visit('/');
    }
}