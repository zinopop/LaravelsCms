<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/20
 * Time: 9:07
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;



class DevelopController extends BaseController{
    public function index(){
        //dd(Artisan::call('creat:route'));
        return view('admin.develop.index');
    }
    /*
     * 获取路由菜单数据
     * */
    public function getRouteData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        $data = Route::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = Route::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }

    /*
     * 路由数据新增页面
     * */
    public function routeAdd(){
        //列出路由类型
        $data = [];
        $data['route_type'] = $this->getEnumData('cm_route','route_type');
        $data['route_list'] = Route::select(['route_name','id'])->get()->toArray();
        $data['submit_type'] = 'add';
        return view('admin.develop.routeAdd',['data' => $data]);
    }

    /*
     * 路由数据保存
     * */
    public function saveData(Request $request){
        $id = $request->input('id');
        $type = $request->input('submit_type');
        //新增保存
        if($type == 'add'){
            $request_data = $request->input();
            unset($request_data['submit_type']);
            unset($request_data['_token']);
            unset($request_data['id']);
            if(empty($request_data['route_name'])){
                return ['code'=>500,'msg'=>'路由名称不能为空'];
            }
            foreach ($request_data as $k => $v){
                if($k == 'route_middleware' || $k == 'route_button_set'){
                    if(empty($request_data[$k])){
                        $request_data[$k] = '[]';
                    }else{
                        $request_data[$k] = json_encode($request_data[$k]);
                    }
                }
            }
            $route = new Route;
            $obj = $this->hanldInsertDatabase($route,$request_data,$request->session()->get('users'));
            $i = $obj->save();
            if($i){
                Artisan::call('creat:route');
                return [
                    'code'=>200,
                    'msg'=>'保存成功'
                ];
            }else{
                return [
                    'code' => 500,
                    'msg' => '保存失败'
                ];
            }
        }else if($type == 'edit'){
            //编辑保存
            if(!empty($id)){

            }else{
                return [
                    'code' => 500,
                    'msg' => 'id值为空'
                ];
            }
        }else{
            return [
                'code' => 500,
                'msg' => '错误-002'
            ];
        }

    }

}