<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 11:18
 */
namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\SeaportDict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SeaportController extends BaseController{

    /*
     * 全国口岸
     * */
    public function index(){
        return view('admin.parameter.seaport.index');
    }

    /*
     * 获取全国口岸数据
     * */
    public function getData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        if(!empty($request->input('district_code'))) $where[] = ['district_code','like','%'.$request->input('district_code').'%'];
        if(!empty($request->input('district_name'))) $where[] = ['district_name','like','%'.$request->input('district_name').'%'];
        $data = SeaportDict::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = SeaportDict::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }

    /*
     * 全国口岸详情页
     * */
    public function detail(Request $request){
        $data = [];
        $outParms = SeaportDict::where([
            'id'=>$request->input('id')
        ])->first();
        if(!empty($outParms)){
            $data = $outParms;
        }
        return view('admin.parameter.seaport.detail',['data'=>$data]);
    }

    /*
     * 全国口岸数据保存
     * */
    public function save(Request $request){
        if($request->input('submit_type') == 'edit'){
            $packages = SeaportDict::find($request->input('id'));
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
            $packages = new SeaportDict;
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
     * 全国口岸删除
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
        if(app(SeaportDict::class)->updateBatch($up_data) != false){
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