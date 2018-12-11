<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 14:15
 */
namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\TradeDict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TradeController extends BaseController{
    /*
     * 贸易方式
     * */
    public function index(){
        return view('admin.parameter.trade.index');
    }


    /*
     * 获取贸易方式数据
     * */
    public function getData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        if(!empty($request->input('code'))) $where[] = ['code','like','%'.$request->input('code').'%'];
        if(!empty($request->input('short_name'))) $where[] = ['short_name','like','%'.$request->input('short_name').'%'];
        if(!empty($request->input('full_name'))) $where[] = ['full_name','like','%'.$request->input('full_name').'%'];
        $data = TradeDict::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = TradeDict::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }

    /*
     * 贸易方式详情页
     * */
    public function detail(Request $request){
        $data = [];
        $outParms = TradeDict::where([
            'id'=>$request->input('id')
        ])->first();
        if(!empty($outParms)){
            $data = $outParms;
        }
        return view('admin.parameter.trade.detail',['data'=>$data]);
    }


    /*
     * 贸易方式保存
     * */
    public function save(Request $request){
        if($request->input('submit_type') == 'edit'){
            $packages = TradeDict::find($request->input('id'));
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
            $packages = new TradeDict;
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
     * 贸易方式删除
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
        if(app(TradeDict::class)->updateBatch($up_data) != false){
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