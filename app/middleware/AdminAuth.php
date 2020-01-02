<?php
declare (strict_types = 1);

namespace app\middleware;

class AdminAuth
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {

        $uid = app()->session->get('user_id');
      //  var_dump($uid);

        if(!isset($uid) ||empty($uid)) {
            return redirect('/admin/login');
        }
        $request->uid = $uid;
        return $next($request);
     }
}
