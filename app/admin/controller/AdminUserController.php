<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\model\AdminRole;
use app\model\AdminUser;
use app\validate\AdminUserValidate;
use think\facade\Filesystem;
use think\Request;

class AdminUserController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request, AdminUser $model)
    {
        $param = $request->param();
        $where = [];
        if (!isset($param['_keywords']) ||empty($param['_keywords'])) {
            $param['_keywords'] = "";
        }
//        if (isset($param['term_id']) && !empty($param['term_id'])) {
//            $where[] = ['term_id', '=', $param['term_id']];
//        } else {
//            $param['term_id'] = 0;
//        }
//        if (isset($param['career_id']) && !empty($param['career_id'])) {
//            $where[] = ['career_id', '=', $param['career_id']];
//        } else {
//            $param['career_id'] = 0;
//        }
        $where[] = ['id', '>', 0];
//
//
//        $data = $model->where('name|school|grade|parent_name|town|id_card|often_mobile|mobile','like','%'.$param['_keywords'].'%')->where([$where])->paginate($this->admin['per_page'], false);


        $data = $model->whereLike('username','%'.$param['_keywords'].'%')->paginate($this->admin['per_page']);
        //关键词，排序等赋值


        return view_admin('admin_user/index', ['data' => $data, 'page' => $data->render(), 'total' => $data->total(),'param'=>$param]);

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create(AdminRole $adminRole)
    {
        $role = $adminRole->select();
        return view_admin('admin_user/add', ['role' => $role]);
    }

    /**
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request, AdminUser $model, AdminUserValidate $validate)
    {
        $param = $request->param();
        $userId = $this->getUserId();
        $role = $model->where('id', $userId)->value('role');
        if ($role != 1) {
            error(0, '您不是管理员');
        }
        $validate_result = $validate->scene('add')->check($param);
        if (!$validate_result) {
            error(0, $validate->getError());
        }
        if (empty($_FILES['avatar']['name'])) {
            return error(0, '请上传图片');
        }
        $file = $request->file('avatar');
        $saveName = Filesystem::disk('public')->putFile('uploads', $file);
        $param['avatar'] ='/'.$saveName;
        $result = $model::create($param);

        $url = URL_BACK;
        if (isset($param['_create']) && $param['_create'] == 1) {
            $url = URL_RELOAD;
        }

        return $result ? success(1, '修改成功', $url) : error();


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


    public function edit($id, AdminRole $adminRole,AdminUser $model)
    {
        $role = $adminRole->select();
        $data = $model->find($id);
        return view_admin('admin_user/add', ['role' => $role,'data'=>$data]);
    }


    public function update(Request $request, $id,AdminUser $model,AdminUserValidate $validate)
    {

        $param = $request->param();


        $validate_result = $validate->scene('edit')->check($param);
        if (!$validate_result) {
            error(0, $validate->getError());
        }
        if (empty($_FILES['avatar']['name'])) {
            return error(0, '请上传图片');
        }
        $file = $request->file('avatar');

        $saveName = Filesystem::disk('public')->putFile('uploads', $file);

        $param['avatar'] ='/'.$saveName;
        $result = $model->where('id',$id)->save($param);

        $url = URL_BACK;
        if (isset($param['_create']) && $param['_create'] == 1) {
            $url = URL_RELOAD;
        }

        return $result ? success(1, '添加成功', $url) : error();
    }


    public function delete($id, AdminUser $model)
    {
        if ($id == 1) {
            return error(0, '无法删除');
        }

        $res = $model->where('id', $id)->delete();
        return $res ? success() : error();


    }

    public function profile()
    {
        $data = \think\facade\Db::table('admin_user')->where('id', app()->session->get('admin_user_id'))->find();


        return view_admin('admin_user/profile',['data'=>$data]);
    }

    public function logout()
    {
        app()->session->delete('admin_user_id');
        return redirect('/admin');
    }


    public function profileNickname(Request $request)
    {
        $nickname = $request->param('nickname');
        $res = AdminUser::where('id', $this->getUserId())->update(['nickname' => $nickname]);
        return $res ? success(1, '修改成功', URL_RELOAD) : error();
    }

    public function profilePassword(Request $request, AdminUserValidate $validate, AdminUser $model)
    {
        $param = $request->param();
        $validate_result = $validate->scene('password')->check($param);
        if (!$validate_result) {
            error(0, $validate->getError());
        }

        $password = $model->where('id', $this->getUserId())->value('password');
        $password = base64_decode($password);

        $oldPassword = trim($param['old_password']);
        if (!password_verify($oldPassword, $password)) {
            error(0, "原密码错误");
        }
        $res = $model->where('id', $this->getUserId())->update([
            'password' => base64_encode(password_hash($param['password'], PASSWORD_DEFAULT))
        ]);
        return $res ? success(1, '修改成功', URL_RELOAD) : error();


    }

    public function profileAvatar(Request $request)
    {
        if (empty($_FILES['avatar']['name'])) {
            return error(0, '请上传图片');
        }
        $file = $request->file('avatar');
        $saveName = Filesystem::disk('public')->putFile('uploads', $file);

        $res = AdminUser::where('id', $this->getUserId())->update(['avatar' => '/' . $saveName]);
        return $res ? success(1, '修改成功', URL_RELOAD) : error();
    }
}
