<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    public function test_simple_mocks()
    {
        $user = Mockery::mock(['getName' => 'Jack']);
        $user->getName();
    }
}
