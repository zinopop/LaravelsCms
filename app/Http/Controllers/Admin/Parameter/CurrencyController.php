<?php
namespace App\Http\Controllers\Admin\Parameter;
use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\CurrencyDict;
use Illuminate\Http\Request;

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

}