<?php
declare (strict_types=1);

namespace app\controller\admin;


use app\model\Setting;
use app\model\Term;

use think\facade\Db;
use think\Request;

class SettingController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request, Term $model)
    {
        $param = $request->param();
        $model = $model->scope('where', $param);

        $data = $model->paginate($this->admin['per_page'], false, ['query' => $request->get()]);
        //关键词，排序等赋值

        return view_admin('term/index', ['data' => $data, 'page' => $data->render(), 'total' => $data->total(), $request->get()]);

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view_admin('setting/add');
    }


    public function save(Request $request, Setting $model)
    {
        $param = $request->param();
        $result = $model::create($param);
        $url = URL_BACK;
        if (isset($param['_create']) && $param['_create'] == 1) {
            $url = URL_RELOAD;
        }

        return $result ? success(1, '添加成功', $url) : error();

    }


    public function edit(Setting $model)
    {
        $apply = Setting::$apply;
        $data = $model->select();
        foreach ($data as $value) {
            if($value->setting_type == 1) {
                $value->value = json_decode($value->value,true);
            }
        }



        return view_admin('setting/edit', ['apply' => $apply, 'data' => $data]);
    }


    public function update(Request $request, Setting $model)
    {

        $param = $request->param();
        foreach ($param as $key => $value) {
            $data = Db::table('setting')->where('name', $key)->find();
            switch ($data['setting_type']) {
                case 1:
                    $value1 = json_encode($value);
                    break;
                case 2:
                    $value1 = $value;
                    break;

                default:
                    $value1 = $value;

            }
            Db::table('setting')->where('id', $data['id'])->update(['value' => $value1]);
        }
        return success(1,'更新成功',URL_RELOAD);


    }

    public function delete($id, Term $model)
    {


        $res = $model->whereIn('id', $id)->delete();

        return $res ? success() : error();
    }


}
