<?php
namespace App\Http\Controllers\Admin\Parameter;
use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\CurrencyDict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CurrencyController extends BaseController{
    public function index(){
//        return redirect()->route('admin.error.index')->with('msg','币制代码页面');
        return view('admin.parameter.currency.index');
    }

    /*
    * 获取币制代码数据
    * */
    public function getData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        if(!empty($request->input('chinese_name'))) $where[] = ['chinese_name','like','%'.$request->input('chinese_name').'%'];
        if(!empty($request->input('english_name'))) $where[] = ['english_name','like','%'.$request->input('english_name').'%'];
        $data = CurrencyDict::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = CurrencyDict::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }

    /*
     * 币制代码详情页
     * */
    public function detail(Request $request){
        $data = [];
        $currency = CurrencyDict::where([
            'id'=>$request->input('id')
        ])->first();
        if(!empty($currency)){
            $data = $currency;
        }
        return view('admin.parameter.currency.detail',['data'=>$data]);
    }

    /*
     * 币制代码数据保存
     * */
    public function save(Request $request){
        if($request->input('submit_type') == 'edit'){
            $packages = CurrencyDict::find($request->input('id'));
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
            $packages = new CurrencyDict;
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
     * 币制代码数据删除
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
        if(app(CurrencyDict::class)->updateBatch($up_data) != false){
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