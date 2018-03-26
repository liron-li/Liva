<?php

namespace App\Http\Controllers;


use Illuminate\Container\Container;

class BaseController
{
    public $app;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->app = Container::getInstance();
    }

    /**
     * @param $path
     * @return mixed
     */
    public function view($path)
    {
        return $this->app->make($path);
    }

}