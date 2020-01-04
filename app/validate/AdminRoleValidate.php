<?php
/**
 * 轮播图验证器
 */

namespace app\validate;

use think\Validate;

class AdminRoleValidate extends Validate
{
    protected $rule = [
        'name|名称' => 'require',
        'description|描述' => 'require',

    ];

    protected $message = [
        'name.require' => '名称不能为空',
        'description.require' => '描述不能为空',

    ];

    protected $scene = [
        'add' => ['name', 'description',],
        'edit' => ['name', 'description',],

    ];


}
