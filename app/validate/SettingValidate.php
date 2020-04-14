<?php
/**
 * 轮播图验证器
 */

namespace app\validate;

use think\Validate;

class SettingValidate extends Validate
{
    protected $rule = [
        'name|字段名称' => 'require|alphaDash|length:3,20|unique:settings',
        'name_desc|字段描述' => 'require|length:1,15',
        'description|提示' => 'length:6,50',
        'setting_type' => 'require'
        //'value_description|字段选择值'=>'require',


    ];

    protected $message = [
        'name.require' => '名称不能为空',
        'password.require' => '密码不能为空',
        'role.require' => '请选择角色',
        'username.unique' => '已存在该用户名',
    ];

    protected $scene = [
        'add' => ['name', 'name_desc', 'description','setting_type'],
        'edit' =>  ['name', 'name_desc', 'description','setting_type'],


    ];

    public function scenePassword()
    {
        return $this->only(['old_password', 'password'])->append('password', 'confirm');
    }


}
