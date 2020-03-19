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
        $data = array(
            0 => array('id' => 1, 'parent_id' => 0, 'name' => '后台首页', 'url' => '/admin', 'icon' => 'fa-home', 'is_show' => 1, 'sort_id' => 99, 'log_method' => '不记录',),
            1 => array('id' => 2, 'parent_id' => 0, 'name' => '系统管理', 'url' => '/admin/sys', 'icon' => 'fa-desktop', 'is_show' => 1, 'sort_id' => 1099, 'log_method' => '不记录',),
            2 => array('id' => 3, 'parent_id' => 2, 'name' => '用户管理', 'url' => '/admin/admin_user', 'icon' => 'fa-user', 'is_show' => 1, 'sort_id' => 1000, 'log_method' => '不记录',),
            3 => array('id' => 7, 'parent_id' => 2, 'name' => '角色管理', 'url' => '/admin/admin_role', 'icon' => 'fa-group', 'is_show' => 1, 'sort_id' => 1000, 'log_method' => '不记录',),
            4 => array('id' => 11, 'parent_id' => 7, 'name' => '角色授权', 'url' => '/admin/admin_role/access', 'icon' => 'fa-key', 'is_show' => 0, 'sort_id' => 1000, 'log_method' => 'POST',),
            5 => array('id' => 12, 'parent_id' => 2, 'name' => '菜单管理', 'url' => '/admin/admin_menu', 'icon' => 'fa-align-justify', 'is_show' => 1, 'sort_id' => 1000, 'log_method' => '不记录',),
            6 => array('id' => 18, 'parent_id' => 2, 'name' => '个人资料', 'url' => '/admin/admin_user/profile', 'icon' => 'fa-smile-o', 'is_show' => 1, 'sort_id' => 1000, 'log_method' => 'POST',)
        );
        foreach ($data as $value) {

         \think\facade\Db::table('admin_menu')->insert($value);
        }
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
