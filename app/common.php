<?php
// 应用公共文件
use think\Response;
use think\response\View;
use think\response\Redirect;

const URL_CURRENT = 'url://current';
const URL_RELOAD = 'url://reload';
const URL_BACK = 'url://back';
if (!function_exists('view_admin')) {
    /**
     * 渲染模板输出
     * @param string   $template 模板文件
     * @param array    $vars     模板变量
     * @param int      $code     状态码
     * @param callable $filter   内容过滤
     * @return \think\response\View
     */
    function view_admin(string $template = '', $vars = [], $code = 200, $filter = null): View
    {
        $template = 'admin/'.$template;
        return Response::create($template, 'view', $code)->assign($vars)->filter($filter);
    }
}

if (!function_exists('result')) {
    function result($code = 0, $msg = 'unknown', $data = '', $url = null, $wait = 3, array $header = [])
    {
        $url      = (strpos($url, '://') || 0 === strpos($url, '/')) ? $url : url($url);
            $result   = [
                'code' => $code,
                'msg'  => $msg,
                'data' => $data,
                'url'  => $url,
                'wait' => $wait,
            ];
            $response = Response::create($result, 'json')->header($header);
            throw new \think\exception\HttpResponseException($response);
    }
}


if(!function_exists('isPjax1')) {
    function isPjax1()
    {
         return app()->request->isPjax();
    }
}

if(!function_exists('get_menu_tree')) {
    function get_menu_tree()
    {

        return  \app\facade\facade\AdminTreeFacade::get();
    }
}

if (!function_exists('success')) {

    function success(int $code =1,$msg = '操作成功', $url = URL_BACK, $data = '', $wait = 0, array $header = [])
    {

        result($code, $msg, $data, $url, $wait, $header);
    }
}


if (!function_exists('error')) {
    function error(int $code= 0,$msg = '操作失败', $url = URL_CURRENT, $data = '', $wait = 0, array $header = [])
    {

        result($code, $msg, $data, $url, $wait, $header);
    }
}

function rc4($key, $pt)
{
    $s = array();
    for ($i=0; $i<256; $i++) {
        $s[$i] = $i;
    }

    $j = 0;
    $key_len = strlen($key);
    for ($i=0; $i<256; $i++) {
        $j = ($j + $s[$i] + ord($key[$i % $key_len])) % 256;
        //swap
        $x = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $x;
    }
    $i = 0;
    $j = 0;
    $ct = '';
    $data_len = strlen($pt);
    for ($y=0; $y< $data_len; $y++) {
        $i = ($i + 1) % 256;
        $j = ($j + $s[$i]) % 256;
        //swap
        $x = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $x;
        $num = $s[($s[$i] + $s[$j]) % 256];
     $num = $num %128 -8 ;
        dump($num);
        $ct .= chr($num);
    }
    return $ct;
}

