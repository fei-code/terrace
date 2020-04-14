<?php
namespace app\facade\facade;

use app\facade\HtmlForm;
use think\Facade;

/**
 * @see HtmlForm
 * @mixin HtmlForm
 */
class HtmlFormFacade extends Facade
{


    protected static function getFacadeClass()
    {
        return 'app\facade\HtmlForm';
    }
}