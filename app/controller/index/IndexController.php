<?php
declare (strict_types=1);

namespace app\controller\index;




use app\facade\facade\MacAddressFacade;
use think\facade\Db;
use think\facade\View;
use think\Request;

class IndexController extends Controller
{

    /**
     * @param Request $request
     * @return \think\Response|void
     */
    public function index(Request $request)
    {


        $result = Db::table('payment')->where('uid',9852221)->where('status',1)->sum('money');

        view_assign('a','aaa');
      return view_home('index/index');
//        $route = explode('@',$request->rule()->getName());
//        //方法
//        $action = $route[1];
//        $controllers = explode("\\",$route[0]);
//        //控制器
//        $controller = str_replace("Controller",'',$controllers[4]);
//        Db::table('admin_role_user')->insert(['role_id'=>1,'admin_user_id'=>1]);
//        dump($action);
//      dump($controller);


    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {

    }

    /**
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param \think\Request $request
     * @param int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


}
