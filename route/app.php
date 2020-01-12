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
    Route::group(function () {

        Route::get('/', '\app\controller\admin\IndexController@index');
        Route::resource('admin_menu', '\app\controller\admin\AdminMenuController');
        Route::post('admin_menu/del', '\app\controller\admin\AdminMenuController@del');//批量删除
        Route::resource('admin_user', '\app\controller\admin\AdminUserController');
        Route::resource('admin_role', '\app\controller\admin\AdminRoleController');
        Route::get('admin_role/access/:id', '\app\controller\admin\AdminRoleController@access');
        Route::post('admin_role/access', '\app\controller\admin\AdminRoleController@accessPost');
        Route::get('admin_user/profile', '\app\controller\admin\AdminUserController@profile');

        Route::resource('career', '\app\controller\admin\CareerController');
        Route::resource('term', '\app\controller\admin\TermController');
        Route::any('editor/server', '\app\controller\admin\EditorController@server');

        Route::get('apply/a', '\app\controller\admin\ApplyController@a');
        Route::post('apply/a', '\app\controller\admin\ApplyController@aPost');
        Route::get('apply/b/:str', '\app\controller\admin\ApplyController@b');
        Route::post('apply/b', '\app\controller\admin\ApplyController@bPost');
        Route::get('setting/create', '\app\controller\admin\SettingController@create');
        Route::post('setting/create', '\app\controller\admin\SettingController@save');
        Route::get('setting/edit', '\app\controller\admin\SettingController@edit');
        Route::post('setting/edit', '\app\controller\admin\SettingController@update');
        Route::get('apply/index', '\app\controller\admin\ApplyController@index');

        Route::post('admin_user/profile_nickname', '\app\controller\admin\AdminUserController@profileNickname');
        Route::post('admin_user/profile_password', '\app\controller\admin\AdminUserController@profilePassword');
        Route::post('admin_user/profile_avatar', '\app\controller\admin\AdminUserController@profileAvatar');
        Route::get('apply/export', '\app\controller\admin\ApplyController@export');
    })->middleware([\app\middleware\AdminAuth::class]);
    Route::get('logout', '\app\controller\admin\AdminUserController@logout');
});
Route::get('/','\app\controller\index\IndexController@index');
Route::get('/','\app\controller\index\IndexController@index');
Route::get('/','\app\controller\index\IndexController@index');
Route::get('detail/:id','\app\controller\index\IndexController@detail');
