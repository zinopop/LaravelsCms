<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10
 * Time: 15:52
 */
namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\CustomsDict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CustomsController extends BaseController{

    /*
     * 海关代码
     * */
    public function index(){
        return view('admin.parameter.customs.index');
    }

    /*
     * 获取海关编码数据
     * */
    public function getData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        if(!empty($request->input('goods_name'))) $where[] = ['goods_name','like','%'.$request->input('goods_name').'%'];
        if(!empty($request->input('goods_code'))) $where[] = ['goods_code','like','%'.$request->input('goods_code').'%'];
        if(!empty($request->input('unit'))) $where[] = ['unit','like','%'.$request->input('unit').'%'];
        if(!empty($request->input('rebate'))) $where[] = ['rebate','like','%'.$request->input('rebate').'%'];
        $data = CustomsDict::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = CustomsDict::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }

    /*
     * 海关编码详情页
     * */
    public function detail(Request $request){
        $data = [];
        $customs = CustomsDict::where([
            'id'=>$request->input('id')
        ])->first();
        if(!empty($customs)){
            $data = $customs;
        }
        return view('admin.parameter.customs.detail',['data'=>$data]);
    }

    /*
     * 海关编码保存
     * */
    public function save(Request $request){
        if($request->input('submit_type') == 'edit'){
            $packages = CustomsDict::find($request->input('id'));
            $obj = $this->hanldUpdateDatabase($packages,Input::except(['_token','submit_type','id']),$request->session()->get('users'));
            $i = $obj->save();
            if($i){
                return [
                    'code' => 200,
                    'msg'=> '保存成功'
                ];
            }else{
                return [
                    'code' => 500,
                    'msg'=> '保存失败'
                ];
            }
        }else if($request->input('submit_type') == 'add'){
            $packages = new CustomsDict;
            $obj = $this->hanldInsertDatabase($packages,Input::except(['_token','submit_type','id']),$request->session()->get('users'));
            $i = $obj->save();
            if($i){
                return [
                    'code' => 200,
                    'msg'=> '保存成功'
                ];
            }else{
                return [
                    'code' => 500,
                    'msg'=> '保存失败'
                ];
            }
        }else{
            return [
                'code'=> 500,
                'msg'=>'保存失败-09'
            ];
        }
    }
    /*
    * 海关编码删除
    * */
    public function del(){
        $data = Input::except(['_token']);
        $up_data = [];
        foreach ($data['idArray'] as $k => $v){
            array_push($up_data,[
                'id'=>$v,
                'is_del'=>'Y'
            ]);
        }
        if(app(CustomsDict::class)->updateBatch($up_data) != false){
            return [
                'code'=>200,
                'msg'=>'删除成功'
            ];
        }else{
            return [
                'code'=>500,
                'msg'=>'删除失败'
            ];
        }

    }
}