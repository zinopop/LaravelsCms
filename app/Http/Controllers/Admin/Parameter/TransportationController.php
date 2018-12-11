<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 15:27
 */
namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\TransportationDict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class TransportationController extends BaseController{
    /*
     * 运输方式
     * */
    public function index(){
        return view('admin.parameter.transportation.index');
    }
    /*
     * 获取运输方式数据
     * */
    public function getData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        if(!empty($request->input('code'))) $where[] = ['code','like','%'.$request->input('code').'%'];
        if(!empty($request->input('name'))) $where[] = ['name','like','%'.$request->input('name').'%'];
        $data = TransportationDict::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = TransportationDict::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }

    /*
     * 运输方式详情页
     * */
    public function detail(Request $request){
        $data = [];
        $outParms = TransportationDict::where([
            'id'=>$request->input('id')
        ])->first();
        if(!empty($outParms)){
            $data = $outParms;
        }
        return view('admin.parameter.transportation.detail',['data'=>$data]);
    }

    /*
     * 运输方式保存
     * */
    public function save(Request $request){
        if($request->input('submit_type') == 'edit'){
            $packages = TransportationDict::find($request->input('id'));
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
            $packages = new TransportationDict;
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
     * 运输方式删除
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
        if(app(TransportationDict::class)->updateBatch($up_data) != false){
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