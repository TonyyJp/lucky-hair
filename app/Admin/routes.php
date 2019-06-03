<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource ('members', MembersController::class);
    $router->resource ('level', LevelController::class);
    $router->resource ('log', LogController::class);

    $router->get ('recharge', 'RechargeController@index');
    $router->get ('consume', 'ConsumeController@index');
    $router->get ('singleconsume', 'SingleconsumeController@index');

    $router->post ('api/recharge', 'CommonController@putRecharge');
    $router->post ('api/consume', 'CommonController@putConsume');
    $router->post ('api/signleconsume', 'CommonController@putSignleconsume');
});
