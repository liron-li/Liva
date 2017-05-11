<?php
/**
 * User: Liron.li
 * Mail: liron.li@outlook.com
 * Date: 2017/3/18
 * Time: 16:29
 */

require __DIR__ . '/../vendor/autoload.php';

// whoops配置
$whoops  = new \Whoops\Run();
$handler = new \Whoops\Handler\PrettyPageHandler();
$handler->setPageTitle('出错了');
$whoops->pushHandler($handler);
if (\Whoops\Util\Misc::isAjaxRequest()) {
    $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler());
}
$whoops->register();

//服务容器
$app = new Illuminate\Container\Container();
//设置容器实例
Illuminate\Container\Container::setInstance($app);
//注册事件ServiceProvider
with(new Illuminate\Events\EventServiceProvider($app))->register();
//注册路由ServiceProvider
with(new Illuminate\Routing\RoutingServiceProvider($app))->register();

//Eloquent配置
$manager = new \Illuminate\Database\Capsule\Manager();
$manager->addConnection(require __DIR__ . '/../config/database.php');
$manager->bootEloquent();

//添加config实例
$app->instance('config', new Illuminate\Support\Fluent());
//view文件路径
$app['config']['view.compiled'] = __DIR__ . '/../storage/framework/views/';
$app['config']['view.paths']    = [__DIR__ . '/../resources/views/'];

//注册view和file
with(new Illuminate\View\ViewServiceProvider($app))->register();
with(new Illuminate\Filesystem\FilesystemServiceProvider($app))->register();
//引入路由文件
require __DIR__ . '/../routes/routes.php';

$request = Illuminate\Http\Request::createFromGlobals();

$response = $app['router']->dispatch($request);

$response->send();
