<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 16:02
 */
namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\UnitDict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UnitController extends BaseController{
    /*
     * 计量单位
     * */
    public function index(){
        return view('admin.parameter.unit.index');
    }

    /*
     * 获取计量单位数据
     * */
    public function getData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        if(!empty($request->input('code'))) $where[] = ['code','like','%'.$request->input('code').'%'];
        if(!empty($request->input('name'))) $where[] = ['name','like','%'.$request->input('name').'%'];
        $data = UnitDict::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = UnitDict::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }

    /*
     * 计量单位详情页
     * */
    public function detail(Request $request){
        $data = [];
        $outParms = UnitDict::where([
            'id'=>$request->input('id')
        ])->first();
        if(!empty($outParms)){
            $data = $outParms;
        }
        return view('admin.parameter.unit.detail',['data'=>$data]);
    }

    /*
     * 计量单位保存
     * */
    public function save(Request $request){
        if($request->input('submit_type') == 'edit'){
            $packages = UnitDict::find($request->input('id'));
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
            $packages = new UnitDict;
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
     * 计量单位删除
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
        if(app(UnitDict::class)->updateBatch($up_data) != false){
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