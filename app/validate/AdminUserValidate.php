<?php
/**
 * 轮播图验证器
 */

namespace app\validate;

use think\Validate;

class AdminUserValidate extends Validate
{
    protected $rule = [
        'old_password|原密码' => 'require',
        'username|用户名' => 'require|length:5,15|unique:admin_user',
        'password|密码' => 'require|length:6,16',
        'role|角色' => 'require',



    ];

    protected $message = [
        'name.require' => '名称不能为空',
        'password.require' => '密码不能为空',
        'role.require' => '请选择角色',
        'username.unique' => '已存在该用户名',
    ];

    protected $scene = [
        'add' => ['username', 'password', 'role'],
        'edit' => ['username', 'description',],
        'password' => ['old_password', 'password']

    ];

    public function scenePassword()
    {
        return $this->only(['old_password','password'])->append('password', 'confirm');
    }


}
