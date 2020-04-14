<?php
declare (strict_types=1);

namespace app\admin\controller;



use app\facade\facade\MacAddressFacade;
use think\console\command\Version;
use think\facade\Db;
use think\facade\View;
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
        $mysqlVersion = Db::query('select version()');



        $data = [
            'os' => php_uname('s'),//操作系统
            'ip' => app()->request->ip(),
            'php_version' => PHP_VERSION,
            'thinkphp_version' => app()->version(),
            'mysql_version'=>$mysqlVersion[0]['version()'],
        ];

        return view_admin('index/index', ['data' => $data]);
    }


}
