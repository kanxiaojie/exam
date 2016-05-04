<?php

class PagesControllerTest extends TestCase
{
    public function test_home()
    {
        $this->withoutMiddleware();

        $this->action('get', 'PagesController@home');

        $this->assertResponseOk();
    }
}