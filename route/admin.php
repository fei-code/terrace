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

$adminRoute = '\app\admin\controller';

Route::group('admin', function () use ($adminRoute) {

    Route::get('login', $adminRoute . '\LoginController@index')->middleware([\app\middleware\AdminVerify::class]);
    Route::post('login', $adminRoute . '\LoginController@update');
    Route::group(function () use ($adminRoute) {

        Route::get('/', $adminRoute . '\IndexController@index');
        Route::resource('admin_menu', $adminRoute . '\AdminMenuController');
        Route::post('admin_menu/del', $adminRoute . '\AdminMenuController@del');//批量删除
        Route::resource('admin_user', $adminRoute . '\AdminUserController');
        Route::resource('admin_role', $adminRoute . '\AdminRoleController');
        Route::get('admin_role/access/:id', $adminRoute . '\AdminRoleController@access');
        Route::post('admin_role/access', $adminRoute . '\AdminRoleController@accessPost');
        Route::post('admin_user/profile_nickname', $adminRoute . '\AdminUserController@profileNickname');
        Route::post('admin_user/profile_password', '\AdminUserController@profilePassword');
        Route::post('admin_user/profile_avatar', $adminRoute . '\AdminUserController@profileAvatar');
        Route::get('admin_user/profile', $adminRoute . '\AdminUserController@profile');
        Route::any('editor/server', $adminRoute . '\EditorController@server');
        Route::resource('setting', $adminRoute . '\SettingController');
        Route::get('setting/add', $adminRoute . '\SettingController@add');
        Route::post('setting/add', $adminRoute . '\SettingController@addPost');
        Route::resource('user', $adminRoute . '\UserController');

    })->middleware([\app\middleware\AdminAuth::class]);
    Route::get('logout', $adminRoute .'\AdminUserController@logout');
});

