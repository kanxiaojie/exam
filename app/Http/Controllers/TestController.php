<?php

namespace App\Http\Controllers;

use App\Contracts\TestContract;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    /**
     * TestController constructor.
     * @param TestContract $test
     */
    public function __construct(TestContract $test)
    {
        $this->test = $test;
    }

    public function index()
    {
        $this->test->callMe('TestController');
    }
}
