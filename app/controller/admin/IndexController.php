<?php
declare (strict_types=1);

namespace app\controller\admin;



use app\facade\facade\MacAddressFacade;
use think\console\command\Version;
use think\Request;

class IndexController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $data = [
            'os' => php_uname('s'),//操作系统
            'ip' => app()->request->ip(),
            'php_version' => PHP_VERSION,
            'thinkphp_version' => app()->version(),
        ];
        return view_admin('index/index', ['data' => $data]);
    }


}
