<?php
declare (strict_types=1);

namespace app\middleware;

use think\facade\Db;

class AdminAuth
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {

        $uid = app()->session->get('admin_user_id');

      //  var_dump($uid);


        //  var_dump($uid);

        if (!isset($uid) || empty($uid)) {
            if ($request->isAjax()) {
                return error(401, '请登录');
            } else {
                return redirect('/admin/login');
            }

        }
        $url ='/'.$request->rule()->getRule();



        $menuId = Db::table('admin_menu')->where('url',$url)->find();



        $roleId = Db::table('admin_user')->where('id',$uid)->value('role');

        $roleMenu = Db::table('admin_role')->where('id',$roleId)->value('menu');

        $menu =  Db::table('admin_menu')->column('id');
        if($roleMenu == '*') {
            $roleMenu = $menu;
        } else {
            $roleMenu = explode(',',$roleMenu);

        }

        if(in_array($menuId,$menu)) {
            if(!in_array($menuId,$roleMenu)) {
                if ($request->isAjax()) {
                    return error(0, '无权限');
                } else {
                    return redirect('/admin');
                }
            }
        }





        $request->uid = $uid;
        return $next($request);
    }
}
