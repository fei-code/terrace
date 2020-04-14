<?php

namespace app\admin\controller;

use app\BaseController;
use think\App;
use think\facade\View;

class Controller extends BaseController
{
    public $admin = ['per_page' => 10];

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->admin['user']['username'] = \think\facade\Db::table('admin_user')->where('id',app()->session->get('admin_user_id'))->value('nickname') ?? '1111';
        $this->admin['user']['avatar'] = \think\facade\Db::table('admin_user')->where('id',app()->session->get('admin_user_id'))->value('avatar') ?? '/static/admin/images/avatar.jpg';
        View::assign('admin',$this->admin);
    }


    public function getUserId()
    {
        return app()->session->get('admin_user_id');
    }
}
