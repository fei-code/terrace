<?php
namespace app\facade\facade;

use think\Facade;

class AdminTreeFacade extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\facade\AdminTree';
    }
}