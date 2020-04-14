<?php
/**
 * 轮播图验证器
 */

namespace app\validate;

use think\Validate;

class AdminMenuValidate extends Validate
{
    protected $rule = [
        'parent_id|上级' => 'require|egt:0',
        'name|名称' => 'require',
        'url|url' => 'require|unique:admin_menu',
        'icon|图标' => 'require',
        'sort_id|排序' => 'require',
        'is_show|是否显示' => 'require',

    ];

    protected $message = [


    ];

    protected $scene = [
        'add' => ['parent_id', 'name', 'url', 'icon', 'sort_id', 'is_show'],
        'edit' => ['parent_id', 'name', 'url', 'icon', 'sort_id', 'is_show'],
    ];


}
