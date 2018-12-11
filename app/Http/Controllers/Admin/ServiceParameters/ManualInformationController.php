<?php
/**
 * Created by PhpStorm.
 * User: 30557
 * Date: 2018/11/27
 * Time: 14:04
 */
namespace App\Http\Controllers\Admin\ServiceParameters;
use App\Imports\ManualInformationImport;
use App\Exports\ManualInformationExport;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\CommonActionInterface;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ManualInformationController extends BaseController implements CommonActionInterface {
    //模块名称
    protected $title = "手册信息";
    //模块详情页名称
    protected $detailTitle = "手册信息详情";
    //页面空间
    protected $bladePrefix = 'admin.serviceParameters.manualInformation';
    //控制器需要的模型
    protected $model = \App\Model\Admin\ManualInformation::class;
    //文本框以及验证规则
    protected $filed = [
        'manual_num'=>[
            'type'=>'input',
            'ch_name'=>'手册号',
            'validateTips'=>'手册号不能为空',
            'whereType'=>'like'
        ],
        'style'=>[
            'type'=>'input',
            'ch_name'=>'方式',
            'validateTips'=>'方式不能为空',
            'whereType'=>'like'
        ],
        'num'=>[
            'type'=>'input',
            'ch_name'=>'序号',
            'validateTips'=>'序号不能为空',
            'whereType'=>'='
        ],
        'goods_code'=>[
            'type'=>'input',
            'ch_name'=>'商品代码',
            'validateTips'=>'商品代码不能为空',
            'whereType'=>'='
        ],
        'goods_name'=>[
            'type'=>'input',
            'ch_name'=>'商品名称',
            'validateTips'=>'商品名称不能为空',
            'whereType'=>'like'
        ],
        'format'=>[
            'type'=>'input',
            'ch_name'=>'规格型号',
            'validateTips'=>'规格型号不能为空',
            'whereType'=>'like'
        ],
        'amount'=>[
            'type'=>'input',
            'ch_name'=>'数量',
            'validateTips'=>'数量不能为空',
            'whereType'=>'like'
        ],
        'unit'=>[
            'type'=>'input',
            'ch_name'=>'单位',
            'validateTips'=>'单位不能为空',
            'whereType'=>'like'
        ],
        'price'=>[
            'type'=>'input',
            'ch_name'=>'单价',
            'validateTips'=>'单价不能为空',
            'whereType'=>'='
        ],
        'total'=>[
            'type'=>'input',
            'ch_name'=>'总值',
            'validateTips'=>'总值不能为空',
            'whereType'=>'='
        ],
        'country'=>[
            'type'=>'input',
            'ch_name'=>'原产国',
            'validateTips'=>'原产国不能为空',
            'whereType'=>'like'
        ],
    ];

    public function index(){
        return view($this->bladePrefix.'.'.__FUNCTION__,[
            'prefix'=>$this->getControllerPrefix(),
            'filedArray'=>$this->filed,
            'filed'=>json_encode($this->filed,true),
            'title'=>$this->title
        ]);
    }

    public function getData(Request $request){
        $where = [
            'is_del'=>'N'
        ];
        if(!empty($this->filed)){
            foreach ($this->filed as $k => $v){
                if($v['whereType'] == 'like'){
                    if(!empty($request->input($k))) $where[] = [$k,'like','%'.$request->input($k).'%'];
                }else if($v['whereType'] == '='){
                    if(!empty($request->input($k))) $where[] = [$k,'=',$request->input($k)];
                }
            }
        }
//        if(!empty($request->input('enterprise_short_code'))) $where[] = ['enterprise_short_code','like','%'.$request->input('enterprise_short_code').'%'];
//        if(!empty($request->input('ch_full_name'))) $where[] = ['ch_full_name','like','%'.$request->input('ch_full_name').'%'];
//        if(!empty($request->input('en_full_name'))) $where[] = ['en_full_name','like','%'.$request->input('en_full_name').'%'];
//        if(!empty($request->input('ten_num'))) $where[] = ['ten_num','=',$request->input('ten_num')];
//        if(!empty($request->input('unified_num'))) $where[] = ['unified_num','like',$request->input('unified_num')];
        $data = $this->model::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = $this->model::where($where)->select('id')->count();
        return $this->responseBootData($data,$count);
    }

    public function detail(Request $request){
        $data = [];
        $modelData = $this->model::where([
            'id'=>$request->input('id')
        ])->first();
        if(!empty($modelData)){
            $data = $modelData;
        }
        return view($this->bladePrefix.'.'.__FUNCTION__,[
            'data'=>$data,
            'prefix'=>$this->getControllerPrefix(),
            'filedArray'=>$this->filed,
            'filed'=>json_encode($this->filed,true),
            'title'=>$this->detailTitle
        ]);
    }

    public function save(Request $request){
        if($request->input('submit_type') == 'edit'){
            $packages = $this->model::find($request->input('id'));
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
            $packages = new $this->model;
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

    public function del(){
        $data = Input::except(['_token']);
        $up_data = [];
        foreach ($data['idArray'] as $k => $v){
            array_push($up_data,[
                'id'=>$v,
                'is_del'=>'Y'
            ]);
        }
        if(app($this->model)->updateBatch($up_data) != false){
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

    /*
     * 导出功能
     * */
    public function export(){
        $filename = 'manual_'.date('Ymdhis').'.xlsx';
        $status =  Excel::store(new ManualInformationExport, $filename, 'exportFile');
        if($status){
            return [
                'code'=>200,
                'msg'=>'成功',
                'url'=>Storage::disk('exportFile')->url($filename)
            ];
        }else{
            return [
                'code'=>500,
                'msg'=>'失败'
            ];
        }

//        $filename = 'manualInformationExport.xlsx';
//        $status = (new Collection([[1, 2, 3], [1, 2, 3]]))->storeExcel(
//            $filename,
//            'exportFile',
//            $writerType = null,
//            $headings = false
//        );
//        if($status){
//            return [
//                'code'=>200,
//                'msg'=>'成功',
//                'url'=>Storage::disk('exportFile')->url($filename)
//            ];
//        }else{
//            return [
//                'code'=>500,
//                'msg'=>'失败'
//            ];
//        }
    }

    /*
     * 导入功能
     * */
    public function import(Request $request){
        $file = $request->file('file');
        try {
            if($file->isValid()){
                $ext = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
                $filename = date('Y-m-d-h-i-s').'.'.$ext;
                $i = Storage::disk('exportFile')->put($filename, file_get_contents($path));
                if($i){
                    Excel::import(new ManualInformationImport($request->session()->get('users')), $filename,'exportFile');
                    return [
                        'code'=>200,
                        'msg'=>'导入成功'
                    ];
                }else{
                    return [
                        'code'=>500,
                        'msg'=>'文件上传失败'
                    ];
                }

            }
        }catch (\Exception $e){
            return [
                'code'=>500,
                'msg'=>'被抛出了异常'.$e
            ];
        }

    }
}