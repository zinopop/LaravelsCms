<?php
/**
 * Created by PhpStorm.
 * User: 30557
 * Date: 2018/11/27
 * Time: 14:04
 */
namespace App\Http\Controllers\Admin\ServiceParameters;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class AgencyShopServicerController extends BaseController{
    //模块名称
    protected $title = "代理企业";
    //模块详情页名称
    protected $detailTitle = "代理企业详情";
    //页面空间
    protected $bladePrefix = 'admin.serviceParameters.agency';
    //控制器需要的模型
    protected $model = \App\Model\Admin\AgencyShopServicer::class;
    //文本框以及验证规则
    protected $filed = [
        'enterprise_short_code'=>[
            'type'=>'input',
            'ch_name'=>'企业代码简称',
            'validateTips'=>'企业代码简称不能为空',
            'whereType'=>'like'
        ],
        'ch_full_name'=>[
            'type'=>'input',
            'ch_name'=>'中文全称',
            'validateTips'=>'中文全称不能为空',
            'whereType'=>'like'
        ],
        'en_full_name'=>[
            'type'=>'input',
            'ch_name'=>'英文全称',
            'validateTips'=>'英文全称不能为空',
            'whereType'=>'like'
        ],
        'ten_num'=>[
            'type'=>'input',
            'ch_name'=>'十位编码',
            'validateTips'=>'十位编码不能为空',
            'whereType'=>'='
        ],
        'unified_num'=>[
            'type'=>'input',
            'ch_name'=>'统一编码',
            'validateTips'=>'统一编码不能为空',
            'whereType'=>'='
        ],
//        'testselect'=>[
//            'type'=>'select',
//            'ch_name'=>'测试',
//            'validateTips'=>'asdasd为空',
//            'whereType'=>'=',
//            'selectChose'=>[
//                '是'=>'Y',
//                '否'=>'N'
//            ]
//        ]
    ];

    public function index(){
        return view($this->bladePrefix.'.'.__FUNCTION__,[
            'prefix'=>$this->getControllerPrefix(),
            'filedArray'=>$this->filed,
            'filed'=>json_encode($this->filed,true),
            'title'=>$this->title
        ]);
    }

    /*
     * 获取代理企业数据
     * */
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

    /*
     * 代理企业详情页
     * */
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

    /*
     * 代理企业保存
     * */
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

    /*
     * 代理企业删除
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
}