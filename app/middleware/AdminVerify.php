<?php
declare (strict_types=1);

namespace app\middleware;

class AdminVerify
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

        $uid = app()->session->get('user_id');
        //  var_dump($uid);die;
        if ($uid) {
            return redirect('/admin');
        }
        return $next($request);
    }
}
