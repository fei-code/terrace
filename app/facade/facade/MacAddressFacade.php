<?php
namespace app\facade\facade;

use think\Facade;

class MacAddressFacade extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\facade\MacAddress';
    }
}