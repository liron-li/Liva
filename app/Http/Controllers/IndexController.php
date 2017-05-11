<?php

namespace App\Http\Controllers;


use Illuminate\Container\Container;

class IndexController
{
    public function index()
    {
        $app = Container::getInstance();
        $view = $app->make('view');
        return $view->make('index')->with('data', ['foo', 'bar']);
    }
}