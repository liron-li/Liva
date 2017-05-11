<?php

$view = $app->make('view');

$app['router']->get('/', function () use ($view) {
    return $view->make('welcome');
});

$app['router']->get('/index', 'App\Http\Controllers\IndexController@index');