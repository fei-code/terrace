<?php
declare (strict_types = 1);

namespace app\controller\admin;

use app\model\AdminUser;
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

    /**
     * @param Request $request
     * @param AdminUser $adminUser
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function update(Request $request,AdminUser $adminUser)
    {
        $param = $request->param();
        $validate = Validate::rule([
            'username'  => 'require|max:25',
            'password' => 'require|max:16|min:6'
        ]);

        if (!$validate->check($param)) {
            return json(['code'=>0,'msg'=>$validate->getError()]);
        }
        $data = $adminUser->where('username',$param['username'])->find();
        if(!isset($data)) return json(['code'=>0,'msg'=>'账号不存在']);
        $password = trim($param['password']);
        if(!password_verify($password,base64_decode($data['password']))) {
            return json(['code'=>0,'msg'=>'密码错误']);
        }
        //  $this->checkToken($request);
        app()->session->set('user_id',$data['id']);
        return success(1,'登录成功','/admin');
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
