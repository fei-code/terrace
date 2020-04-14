<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\model\AdminMenu;
use app\validate\AdminMenuValidate;
use think\facade\Validate;
use think\initializer\Error;
use think\Request;

class AdminMenuController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(AdminMenu $adminMenu, Request $request)
    {
        $result = $adminMenu->order('sort_id asc, id asc')->column('*', 'id');
        foreach ($result as $n => $r) {
            $result[$n]['level'] = \app\facade\facade\AdminTreeFacade::getLevel($r['id'], $result);
            $result[$n]['parent_id_node'] = $r['parent_id'] ? ' class="child-of-node-' . $r['parent_id'] . '"' : '';
            $result[$n]['str_manage'] = '<a href="' . "admin_menu/" . $r['id'] . "/edit" . '" class="btn btn-primary btn-xs" title="修改" data-toggle="tooltip"><i class="fa fa-pencil"></i></a> ';
            $result[$n]['str_manage'] .= '<a class="btn btn-danger btn-xs AjaxButtonDelete" data-id="' . $r['id'] . '" data-url="/admin/admin_menu/' . $r['id'] . '"  data-confirm-title="删除确认" data-confirm-content=\'您确定要删除ID为 <span class="text-red"> ' . $r['id'] . ' </span> 的数据吗\'  data-toggle="tooltip" title="删除"><i class="fa fa-trash"></i></a>';
            $result[$n]['is_show'] = (int)$r['is_show'] === 1 ? '显示' : '隐藏';
            $result[$n]['log_method'] = $r['log_method'];
        }

        $str = "<tr id='node-\$id' data-level='\$level' \$parent_id_node><td><input type='checkbox' onclick='checkThis(this)'
                     name='data-checkbox' data-id='\$id\' class='checkbox data-list-check' value='\$id' placeholder='选择/取消'>
                    </td><td>\$id</td><td>\$spacer\$name</td><td>\$url</td>
                   <td><i class='fa \$icon'></i><span>(\$icon)</span></td>
                    <td>\$sort_id</td><td>\$is_show</td><td class='td-do'>\$str_manage</td></tr>";
        \app\facade\facade\AdminTreeFacade::initTree($result);
        $data = \app\facade\facade\AdminTreeFacade::getTree(0, $str);


        return view_admin('admin_menu/index', ['data' => $data]);
    }

    public function create(AdminMenu $adminMenu)
    {
        $parents = $this->menu();

        return view_admin('admin_menu/add', ['parents' => $parents, 'log_method' => $adminMenu->logMethod]);
    }

    public function save(\app\Request $request, AdminMenu $adminMenu, AdminMenuValidate $validate)
    {
        $param = $request->param();
        if (!$validate->scene('add')->check($param)) {
            return error(0, $validate->getError());
        }
        $result = $adminMenu->save($param);
        return $result ? success() : error();
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
    public function edit($id, AdminMenu $adminMenu)
    {
        $data = $adminMenu->find($id);

        $parent_id = $data->parent_id;
        $parents = $this->menu($parent_id);

        return view_admin('admin_menu/add', ['data' => $data, 'parents' => $parents, 'log_method' => $adminMenu->logMethod]);
    }

    public function update($id, \app\Request $request, AdminMenu $adminMenu, AdminMenuValidate $validate)
    {
        $data = $adminMenu->find($id);
        $param = $request->param();
        $validate = Validate::rule([
            'parent_id|上级' => 'require|egt:0',
            'name|名称' => 'require',
            'url|url' => 'require|unique:admin_menu',
            'icon|图标' => 'require',
            'sort_id|排序' => 'require',
            'is_show|是否显示' => 'require',
        ]);
        if (!$validate->scene('edit')->check($param)) {
            return error(0, $validate->getError());
        }
        $result = $data->save($param);
        return $result ? success() : error();
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function delete($id, AdminMenu $adminMenu)
    {

        $count = $adminMenu->where('parent_id', $id)->count();
        if ($count > 0) {
            return error(0, '此菜单下级还存在');
        }

        $res = $adminMenu->whereIn('id', $id)->delete();

        return $res ? success() : error();
    }

    public function del(Request $request, AdminMenu $adminMenu)
    {
        $ids = $request->param('id');
        foreach ($ids as $id) {
            $count = $adminMenu->where('parent_id', $id)->count();
            if ($count > 0) {
                return error(0, '此菜单下级还存在');
            }
        }
        $res = $adminMenu->whereIn('id', $ids)->delete();
        return $res ? success() : error();
    }

    //菜单选择 select树形选择
    protected function menu($selected = 0, $current_id = 0)
    {
        $result = AdminMenu::where('id', '<>', $current_id)->order('sort_id', 'asc')->order('id', 'asc')->column('parent_id,name,sort_id', 'id');
        foreach ($result as $r) {
            $r['selected'] = (int)$r['id'] === (int)$selected ? 'selected' : '';
        }

        $str = "<option value='\$id' \$selected >\$spacer \$name</option>";
        \app\facade\facade\AdminTreeFacade::initTree($result);
        return \app\facade\facade\AdminTreeFacade::getTree(0, $str, $selected);
    }
}
