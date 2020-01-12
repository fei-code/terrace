<?php
declare (strict_types=1);

namespace app\controller\index;




use think\facade\Db;
use think\Request;

class IndexController extends Controller
{
        public function index()
        {

            return view_home('index/index');
        }
}
