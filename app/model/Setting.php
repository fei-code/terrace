<?php
declare (strict_types=1);

namespace app\model;

use think\Model;

/**
 * @mixin think\Model
 */
class Setting extends Model
{
    public static $apply = [
        1 => '姓名',
        2 => '性别',
        3 => '年龄',
        4 => '身份证号码',
        5 => '镇',
        6 => '学校',
        7 => '年级',
        8 => '父母姓名',
        9 => '常用电话',
        10 => '联系电话'
    ];

    public static $applyName = [
        'name' => 1,
        'sex' => 2,
        'age' => 3,
        'id_card' => 4,
        'town' => 5,
        'school' => 6,
        'grade' => 7,
        'parent_name' => 8,
        'often_mobile' => 9,
        'mobile' => 10
    ];
}
