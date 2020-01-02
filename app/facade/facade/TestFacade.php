<?php
namespace app\facade\facade;

use think\Facade;

class TestFacade extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\facade\Test';
    }
}