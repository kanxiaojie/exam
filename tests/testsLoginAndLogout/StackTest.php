<?php

namespace tests\testsLoginAndLogout;

use PHPUnit_Framework_TestCase;

class StackTest extends PHPUnit_Framework_TestCase
{
    public function test_empty()
    {
        $stack = array();
        $this->assertEmpty($stack);

        return $stack;
    }

    /**
     * @depends test_empty
     * @param array $stack
     * @test
     * @return array
     */

    public function test_push(array $stack)
    {
        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertNotEmpty($stack);

        return $stack;
    }


    /**
     * @depends test_push
     * @param array $stack
     * @test
     * @return array
     */

    public function test_pop(array $stack)
    {
        $this->assertEquals('foo', array_pop($stack));
        $this->assertEmpty($stack);
    }

}