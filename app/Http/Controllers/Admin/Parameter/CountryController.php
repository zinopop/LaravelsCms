<?php
namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\CountryDict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CountryController extends BaseController{
    //国别参数
    public function index(){
        return view('admin.parameter.country.index');
    }

    /*
     * 获取国别参数数据
     * */
    public function getData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        if(!empty($request->input('chinese_name'))) $where[] = ['chinese_name','like','%'.$request->input('chinese_name').'%'];
        if(!empty($request->input('en_name'))) $where[] = ['en_name','like','%'.$request->input('en_name').'%'];
        $data = CountryDict::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = CountryDict::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }


    /*
     * 国别参数详情页
     * */
    public function detail(Request $request){
        $data = [];
        $country = CountryDict::where([
            'id'=>$request->input('id')
        ])->first();
        if(!empty($country)){
            $data = $country;
        }
        return view('admin.parameter.country.detail',['data'=>$data]);
    }

    /*
     * 国别参数保存
     * */
    public function save(Request $request){
        if($request->input('submit_type') == 'edit'){
            $packages = CountryDict::find($request->input('id'));
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
            $packages = new CountryDict;
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
     * 国别参数删除
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
        if(app(CountryDict::class)->updateBatch($up_data) != false){
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