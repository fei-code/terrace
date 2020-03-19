<?php

use think\migration\Seeder;

class Admin extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {

        \think\facade\Db::table('admin_user')->insert([
            'avatar' => '/uploads/20200113\2e910d9b3dc9c7c086da2389f0a30e65.jpg',
            'username' => 'admin',
            'password' => 'JDJ5JDEwJG5RVlNFdDRxc0ExNFBONy5NVVdncmVYalhSQkw3QzB4czlXTkhRL0RmVzJNYVVlR1daYUp1',
            'create_time' => time(),
            'update_time' => time(),
            'role' => 1,
            'nickname' => 'adminCp'
        ]);


        \think\facade\Db::table('admin_role')->insert([
            'id' => 1,
            'name' => '超级管理员',
            'menu' => '*',
            'description' => '超级管理员',
            'create_time' => time(),
            'update_time' => time(),
        ]);
        $data = array(
            0 => array('id' => 1, 'parent_id' => 0, 'name' => '后台首页', 'url' => '/admin', 'icon' => 'fa-home', 'is_show' => 1, 'sort_id' => 99, 'log_method' => '不记录',),
            1 => array('id' => 2, 'parent_id' => 0, 'name' => '系统管理', 'url' => '/admin/sys', 'icon' => 'fa-desktop', 'is_show' => 1, 'sort_id' => 1099, 'log_method' => '不记录',),
            2 => array('id' => 3, 'parent_id' => 2, 'name' => '用户管理', 'url' => '/admin/admin_user', 'icon' => 'fa-user', 'is_show' => 1, 'sort_id' => 1000, 'log_method' => '不记录',),
            3 => array('id' => 7, 'parent_id' => 2, 'name' => '角色管理', 'url' => '/admin/admin_role', 'icon' => 'fa-group', 'is_show' => 1, 'sort_id' => 1000, 'log_method' => '不记录',),
            4 => array('id' => 11, 'parent_id' => 7, 'name' => '角色授权', 'url' => '/admin/admin_role/access', 'icon' => 'fa-key', 'is_show' => 0, 'sort_id' => 1000, 'log_method' => 'POST',),
            5 => array('id' => 12, 'parent_id' => 2, 'name' => '菜单管理', 'url' => '/admin/admin_menu', 'icon' => 'fa-align-justify', 'is_show' => 1, 'sort_id' => 1000, 'log_method' => '不记录',),
            6 => array('id' => 18, 'parent_id' => 2, 'name' => '个人资料', 'url' => '/admin/admin_user/profile', 'icon' => 'fa-smile-o', 'is_show' => 1, 'sort_id' => 1000, 'log_method' => 'POST',)
        );
        foreach ($data as $value) {
            \think\facade\Db::table('admin_menu')->insert($value);
        }
    }
}