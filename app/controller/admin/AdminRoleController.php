<?php
declare (strict_types=1);

namespace app\controller\admin;

use app\model\AdminMenu;
use app\model\AdminRole;
use app\model\AdminUser;
use app\validate\AdminRoleValidate;

use think\facade\Db;
use think\Request;

class AdminRoleController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request, AdminRole $model)
    {
        $param = $request->param();
        $model = $model->scope('where', $param);

        $data = $model->paginate($this->admin['per_page'], false, ['query' => $request->get()]);
        //关键词，排序等赋值

        return view_admin('admin_role/index', ['data' => $data, 'page' => $data->render(), 'total' => $data->total(), $request->get()]);

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view_admin('admin_role/add');
    }


    public function save(Request $request, AdminRoleValidate $validate, AdminRole $model)
    {
        $param = $request->param();
        $validate_result = $validate->scene('add')->check($param);
        if (!$validate_result) {
            return error(0, $validate->getError());
        }
        $result = $model::create($param);
        $url = URL_BACK;
        if (isset($param['_create']) && $param['_create'] == 1) {
            $url = URL_RELOAD;
        }

        return $result ? success(1, '添加成功', $url) : error();

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
    public function edit($id, AdminRole $model)
    {
        $data = $model->find($id);
        return view_admin('admin_role/add', ['data' => $data]);
    }

    /**
     * 保存更新的资源
     *
     * @param \think\Request $request
     * @param int $id
     * @return \think\Response
     */
    public function update(Request $request, $id,AdminRoleValidate $validate, AdminRole $model)
    {
        $param = $request->param();
        $validate_result = $validate->scene('add')->check($param);
        if (!$validate_result) {
            return error(0, $validate->getError());
        }
        $result = $model::where('id',$id)->update($param);
        $url = URL_BACK;
        if (isset($param['_create']) && $param['_create'] == 1) {
            $url = URL_RELOAD;
        }

        return $result ? success(1, '修改成功', $url) : error();
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function delete($id,AdminRole $model)
    {
        $count = AdminUser::where('role',$id)->count();
        if($count > 0) {
            error(0,'此角色下还存在用户');
        }


        $res = $model->whereIn('id', $id)->delete();

        return $res ? success() : error();


    }


    public function access($id, AdminRole $model, Request $request)
    {
        $data = $model->find($id);
        if ($request->isPost()) {
            $param = $request->param();
            if (!isset($param['url'])) {
                return error(0, '请至少选择一项权限');
            }
            if (!in_array(1, $param['url'])) {
                return error(1, '首页权限必选');
            }

            asort($param['url']);

            if (false !== $data->save($param)) {
                return success();
            }
            return error();
        }

        $menu = AdminMenu::order('sort_id', 'asc')->order('id', 'asc')->column('*', 'id');
        $urls = $data->menu;

        if ($urls == "*") {
            $urls = AdminMenu::order('sort_id', 'asc')->order('id', 'asc')->column('id');
        } else {
            if (empty($urls)) {
                $urls = [];
            } else {
                $urls = explode(',', $urls) ?? [];
            }

        }


        $html = $this->authorizeHtml($menu, $urls);


        return view_admin('admin_role/access', ['data' => $data, 'html' => $html]);
    }


    public function accessPost(Request $request, AdminRole $adminRole)
    {
        $param = $request->param();
        $id = $param['id'];

        $adminUserId = app()->session->get('admin_user_id');
        if ($adminUserId == $id) {
            error(0, '超级管理员角色无法修改');
        }
        if ($adminUserId != 1) {
            error(0, '您没有权限修改');
        }
        $menu = $param['url'];
        if (empty($menu)) {
            error(0, '请选择权限');
        }
        $menu = implode(',', $menu);
        $res = $adminRole->where('id', $id)->update(['menu' => $menu]);

        return $res ? success() : error();


    }

    //生成授权html
    protected function authorizeHtml($menu, $auth_menus = [])
    {

        foreach ($menu as $n => $t) {
            $menu[$n]['checked'] = in_array($t['id'], $auth_menus) ? ' checked' : '';
            $menu[$n]['level'] = \app\facade\facade\AdminTreeFacade::getLevel($t['id'], $menu);
            $menu[$n]['width'] = 100 - $menu[$n]['level'];
        }


        \app\facade\facade\AdminTreeFacade::initTree($menu);
        $text = [
            'other' => "<label class='checkbox'  >
                        <input \$checked  name='url[]' value='\$id' level='\$level'
                        onclick='javascript:checkNode(this);' type='checkbox'>
                       \$name
                   </label>",
            '0' => [
                '0' => "<dl class='checkMod'>
                    <dt class='hd'>
                        <label class='checkbox'>
                            <input \$checked name='url[]' value='\$id' level='\$level'
                             onclick='javascript:checkNode(this);'
                             type='checkbox'>
                            \$name
                        </label>
                    </dt>
                    <dd class='bd'>",
                '1' => '</dd></dl>',
            ],
            '1' => [
                '0' => "
                        <div class='menu_parent'>
                            <label class='checkbox'>
                                <input \$checked  name='url[]' value='\$id' level='\$level'
                                onclick='javascript:checkNode(this);' type='checkbox'>
                               \$name
                            </label>
                        </div>
                        <div class='rule_check' style='width: \$width%;'>",
                '1' => "</div><span class='child_row'></span>",
            ]
        ];
        \app\facade\facade\AdminTreeFacade::setText($text);


        return \app\facade\facade\AdminTreeFacade::getAuthTreeAccess(0);
    }
}
