<?php
namespace App\Http\Controllers\Admin\Parameter;
use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\PackagesDict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PackagesController extends BaseController{
    public function index(){
//        return redirect()->route('admin.error.index')->with('msg','包装代码页面测试');
        return view('admin.parameter.packages.index');
    }
    /*
     * 获取包装种类数据
     * */
    public function getData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        if(!empty($request->input('name'))) $where[] = ['name','like','%'.$request->input('name').'%'];
        $data = PackagesDict::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = PackagesDict::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }

    /*
     * 包装种类详情页
     * */
    public function detail(Request $request){
        $data = [];
        $packages = PackagesDict::where([
            'id'=>$request->input('id')
        ])->first();
        if(!empty($packages)){
            $data = $packages;
        }
        return view('admin.parameter.packages.detail',['data'=>$data]);
    }

    /*
     * 包装种类数据保存
     * */
    public function save(Request $request){
        if($request->input('submit_type') == 'edit'){
            $packages = PackagesDict::find($request->input('id'));
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
            $packages = new PackagesDict;
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
     * 包装种类数据删除
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
        if(app(PackagesDict::class)->updateBatch($up_data) != false){
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