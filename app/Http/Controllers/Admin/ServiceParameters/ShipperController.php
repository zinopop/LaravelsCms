<?php
/**
 * Created by PhpStorm.
 * User: 30557
 * Date: 2018/11/9
 * Time: 10:05
 */
namespace App\Http\Controllers\Admin\ServiceParameters;
use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\ShipperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class ShipperController extends BaseController{
    public function index(){
        return view('admin.serviceParameters.shipper.index',['prefix'=>$this->getControllerPrefix()]);
    }

    /*
     * 获取收发货人数据
     * */
    public function getData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        if(!empty($request->input('enterprise_short_code'))) $where[] = ['enterprise_short_code','like','%'.$request->input('enterprise_short_code').'%'];
        if(!empty($request->input('ch_full_name'))) $where[] = ['ch_full_name','like','%'.$request->input('ch_full_name').'%'];
        if(!empty($request->input('en_full_name'))) $where[] = ['en_full_name','like','%'.$request->input('en_full_name').'%'];
        if(!empty($request->input('ten_num'))) $where[] = ['ten_num','=',$request->input('ten_num')];
        if(!empty($request->input('unified_num'))) $where[] = ['unified_num','like',$request->input('unified_num')];
        $data = ShipperService::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = ShipperService::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }

    /*
     * 收发货人详情页
     * */
    public function detail(Request $request){
        $data = [];
        $modelData = ShipperService::where([
            'id'=>$request->input('id')
        ])->first();
        if(!empty($modelData)){
            $data = $modelData;
        }
        return view('admin.serviceParameters.shipper.detail',['data'=>$data,'prefix'=>$this->getControllerPrefix()]);
    }

    /*
     * 收发货人保存
     * */
    public function save(Request $request){
        if($request->input('submit_type') == 'edit'){
            $packages = ShipperService::find($request->input('id'));
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
            $packages = new ShipperService;
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
     * 收发货人删除
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
        if(app(ShipperService::class)->updateBatch($up_data) != false){
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