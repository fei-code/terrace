<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\facade\facade\HtmlFormFacade;
use app\model\Setting;
use app\validate\SettingValidate;
use think\Request;

class SettingController extends Controller
{

    public function index(Request $request, Setting $model)
    {
        $param = $request->param();
        $model = $model->scope('where', $param);
        $data = $model->paginate($this->admin['per_page'], false, ['query' => $request->get()]);
        //关键词，排序等赋值
        return view_admin('setting/index', ['data' => $data, 'page' => $data->render(), 'total' => $data->total(), $request->get()]);

    }

    public function create()
    {
        $settingSelect = HtmlFormFacade::getType();
        return view_admin('setting/create', ['settingSelect' => $settingSelect]);
    }


    public function save(Request $request, Setting $model, SettingValidate $validate)
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


    public function edit($id, Setting $model)
    {
        $data = $model->find($id);
        $settingSelect = HtmlFormFacade::getType();
        return view_admin('setting/edit', ['data' => $data, 'settingSelect' => $settingSelect]);
    }


    public function update($id, Request $request, Setting $model, SettingValidate $validate)
    {

        $param = $request->param();
        $validate_result = $validate->scene('add')->check($param);
        if (!$validate_result) {
            return error(0, $validate->getError());
        }
        $result = $model->where('id', $id)->save($param);
        $url = URL_BACK;
        return success(1, '更新成功', $url);
    }

    public function delete($id, Setting $model)
    {
        $res = $model->whereIn('id', $id)->delete();
        return $res ? success() : error();
    }

    public function add(Setting $setting)
    {
        $data = $setting->select();
        return view_admin('setting/add', ['data' => $data]);
    }

    public function addPost(Request $request,Setting $setting)
    {
        $param = $request->param();
        $data = $setting->select();
        $list = [];
        foreach ($data as $key=>$value) {
            $list[$key]['id'] = $value->id;
            $list[$key]['value'] = $param[$value['name']];
        }
        $res = $setting->saveAll($list);
        return $res ? success(1,'更新成功',URL_RELOAD) : error();


    }

}
