<?php

namespace App\Http\Controllers;


use Illuminate\Container\Container;

class IndexController extends BaseController
{
    public function index()
    {
        return $this->view('index')->with('data', ['foo', 'bar']);
    }
}