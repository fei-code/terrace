<?php
declare (strict_types = 1);

namespace app\controller\admin;

use app\model\AdminUser;
use think\exception\ValidateException;
use think\facade\Validate;
use think\Request;

class LoginController  extends  Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view_admin('login/index');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }


    public function update(Request $request,AdminUser $adminUser)
    {
        $check = $request->checkToken('__token__');

        if(false === $check) {
          return    error(0,'令牌数据无效');

        }
        $param = $request->param();
        $validate = Validate::rule([
            'username'  => 'require|max:25',
            'password' => 'require|max:16|min:6'
        ]);

        if (!$validate->check($param)) {
            return    error(0,$validate->getError());

        }
        $data = $adminUser->where('username',$param['username'])->find();
        if(!isset($data))  return error(0,'账号不存在');
        $password = trim($param['password']);
        if(!password_verify($password,base64_decode($data['password']))) {
            return json(['code'=>0,'msg'=>'密码错误']);
        }

        app()->session->set('admin_user_id',$data['id']);
         success(1,'登录成功','/admin');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
