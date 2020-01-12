<?php

namespace app\controller\admin;

use app\BaseController;

class Controller extends BaseController
{
    public $admin = ['per_page' => 10];


    public function getUserId()
    {
        return app()->session->get('admin_user_id');
    }
}
