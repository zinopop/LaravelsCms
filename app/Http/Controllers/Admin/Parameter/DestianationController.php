<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11
 * Time: 14:39
 */
namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\DestianationDict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class DestianationController extends BaseController{
    /*
     * 境内目的地
     * */
    public function index(){
        return view('admin.parameter.destianation.index');
    }

    /*
     * 获取境内目的地数据
     * */
    public function getData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        if(!empty($request->input('provincial_code'))) $where[] = ['provincial_code','like','%'.$request->input('provincial_code').'%'];
        if(!empty($request->input('provincial_name'))) $where[] = ['provincial_name','like','%'.$request->input('provincial_name').'%'];
        if(!empty($request->input('source_code'))) $where[] = ['source_code','like','%'.$request->input('source_code').'%'];
        if(!empty($request->input('source_name'))) $where[] = ['source_name','like','%'.$request->input('source_name').'%'];
        $data = DestianationDict::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = DestianationDict::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }

    /*
     * 境内目的地详情页
     * */
    public function detail(Request $request){
        $data = [];
        $outParms = DestianationDict::where([
            'id'=>$request->input('id')
        ])->first();
        if(!empty($outParms)){
            $data = $outParms;
        }
        return view('admin.parameter.destianation.detail',['data'=>$data]);
    }

    /*
     * 境内目的地保存
     * */
    public function save(Request $request){
        if($request->input('submit_type') == 'edit'){
            $packages = DestianationDict::find($request->input('id'));
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
            $packages = new DestianationDict;
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
     * 境内目的地删除
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
        if(app(DestianationDict::class)->updateBatch($up_data) != false){
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