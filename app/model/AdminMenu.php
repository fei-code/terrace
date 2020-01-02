<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 * @mixin think\Model
 */
class AdminMenu extends Model
{
    public  $logMethod = [
        0 => '不记录',
        1 => 'GET',
        2 => 'POST',
        3 => 'PUT',
        4 => 'DELETE'
    ];

}
