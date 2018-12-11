<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 9:23
 */
namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\ExemptedDict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ExemptedController extends BaseController{
    /*
     * 免征性质
     * */
    public function index(){
        return view('admin.parameter.exempted.index');
    }

    /*
     * 获取免征性质数据
     * */
    public function getData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        if(!empty($request->input('code'))) $where[] = ['code','like','%'.$request->input('code').'%'];
        if(!empty($request->input('name'))) $where[] = ['name','like','%'.$request->input('name').'%'];
        if(!empty($request->input('mark'))) $where[] = ['mark','like','%'.$request->input('mark').'%'];
        $data = ExemptedDict::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = ExemptedDict::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }
    /*
     * 免征性质详情页
     * */
    public function detail(Request $request){
        $data = [];
        $outParms = ExemptedDict::where([
            'id'=>$request->input('id')
        ])->first();
        if(!empty($outParms)){
            $data = $outParms;
        }
        return view('admin.parameter.exempted.detail',['data'=>$data]);
    }

    /*
     * 免征性质保存
     * */
    public function save(Request $request){
        if($request->input('submit_type') == 'edit'){
            $packages = ExemptedDict::find($request->input('id'));
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
            $packages = new ExemptedDict;
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
     * 免征性质删除
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
        if(app(ExemptedDict::class)->updateBatch($up_data) != false){
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