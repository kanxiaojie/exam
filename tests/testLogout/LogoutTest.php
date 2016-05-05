<?php

class LogoutTest extends TestCase
{
    public function test_logout()
    {
        $this->visit('/login')
            ->click('登录')
            ->seePageIs('/login')
        ;
    }
}