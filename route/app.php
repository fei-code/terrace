<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::group('admin', function () {
    Route::get('login', '\app\controller\admin\LoginController@index')->middleware([\app\middleware\AdminVerify::class]);
    Route::post('login', '\app\controller\admin\LoginController@update');
    Route::group( function () {

        Route::get('/', '\app\controller\admin\IndexController@index');
        Route::resource('admin_menu', '\app\controller\admin\AdminMenuController');
        Route::resource('admin_user', '\app\controller\admin\AdminUserController');
        Route::resource('admin_role', '\app\controller\admin\AdminRoleController');
        Route::get('admin_role/access/:id','\app\controller\admin\AdminRoleController@access');
        Route::post('admin_role/access','\app\controller\admin\AdminRoleController@accessPost');
        Route::get('admin_user/profile','\app\controller\admin\AdminUserController@profile');
        Route::post('admin_menu/del','\app\controller\admin\AdminMenuController@del');
        Route::resource('user', '\app\controller\admin\UserController');
        Route::resource('sign', '\app\controller\admin\SignController');
        Route::resource('problem', '\app\controller\admin\ProblemController');
        Route::resource('news', '\app\controller\admin\NewsController');
        Route::resource('goods', '\app\controller\admin\GoodsController');
        Route::resource('community', '\app\controller\admin\CommunityController');//社区
        Route::resource('category', '\app\controller\admin\CategoryController');
        Route::resource('banner', '\app\controller\admin\BannerController');
        Route::resource('goods', '\app\controller\admin\GoodsController');
        Route::resource('classify', '\app\controller\admin\ClassifyController');
        Route::resource('subscribe', '\app\controller\admin\SubscribeController');//预约
        Route::resource('point', '\app\controller\admin\PointController');//预约
        Route::any('editor/server','\app\controller\admin\EditorController@server');

    })->middleware([\app\middleware\AdminAuth::class]);
});
Route::get('/','\app\controller\index\IndexController@index');
