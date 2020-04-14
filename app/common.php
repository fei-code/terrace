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
     * @param string $template 模板文件
     * @param array $vars 模板变量
     * @param int $code 状态码
     * @param callable $filter 内容过滤
     * @return \think\response\View
     */
    function view_admin(string $template = '', $vars = [], $code = 200, $filter = null): View
    {
        $template = 'admin/view/' . $template;

        return Response::create($template, 'view', $code)->assign($vars)->filter($filter);
    }
}
if(!function_exists('view_assign')) {
    /**
     * 模板变量赋值
     * @param $name
     * @param null $value
     * @return \think\facade\View
     */
    function view_assign($name,$value=null)
    {
        return \think\facade\View::assign($name,$value);
    }
}
if (!function_exists('view_home')) {
    /**
     * 渲染模板输出
     * @param string $template 模板文件
     * @param array $vars 模板变量
     * @param int $code 状态码
     * @param callable $filter 内容过滤
     * @return \think\response\View
     */
    function view_home(string $template = '', $vars = [], $code = 200, $filter = null): View
    {
        $template = 'home/' . $template;
        return Response::create($template, 'view', $code)->assign($vars)->filter($filter);
    }
}
if (!function_exists('result')) {
    function result($code = 0, $msg = 'unknown', $data = '', $url = null, $wait = 3, array $header = [], $token = "")
    {
        $url = (strpos($url, '://') || 0 === strpos($url, '/')) ? $url : url($url);
        if (empty($token)) {
            $token = refresh_token();
        }
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
            'url' => $url,
            'wait' => $wait,
            'token' => $token
        ];
        $response = Response::create($result, 'json')->header($header);
        throw new \think\exception\HttpResponseException($response);
    }
}


if (!function_exists('isPjax1')) {
    function isPjax1()
    {
        return app()->request->isPjax();
    }
}

if (!function_exists('get_menu_tree')) {
    function get_menu_tree()
    {

        return \app\facade\facade\AdminTreeFacade::get();
    }
}

if (!function_exists('success')) {

    function success(int $code = 1, $msg = '操作成功', $url = URL_BACK, $data = '', $wait = 0, array $header = [])
    {

        result($code, $msg, $data, $url, $wait, $header);
    }
}


if (!function_exists('error')) {
    function error(int $code = 0, $msg = '操作失败', $url = URL_CURRENT, $data = '', $wait = 0, array $header = [])
    {

        result($code, $msg, $data, $url, $wait, $header);
    }
}

if (!function_exists('refresh_token')) {
    function refresh_token()
    {
        return token();
    }
}

function setting($name)
{
    return \think\facade\Db::table('setting')->where('name', $name)->value('value');
}

function  admin_url($url)
{
    return "/admin/".$url;
}

function admin_avatar()
{
    $avatar =  \think\facade\Db::table('admin_user')->where('id',app()->session->get('admin_user_id'))->value('avatar') ?? '/static/admin/images/avatar.jpg';
    return $avatar;
}

/**
 *
 * @param string $name 字段描述
 * @param string $field 字段名称
 * @return \app\facade\facade\HtmlFormFacade
 */
function html_form($name,$field)
{
  return  \app\facade\facade\HtmlFormFacade::column($name,$field);
}
