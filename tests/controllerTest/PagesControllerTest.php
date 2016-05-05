<?php

class PagesControllerTest extends TestCase
{
    /**
     *测试调用控制器的home方法
     */
    public function test_home()
    {
        $this->withoutMiddleware();

        $this->action('get', 'PagesController@home');

        $this->assertResponseOk();
    }
}