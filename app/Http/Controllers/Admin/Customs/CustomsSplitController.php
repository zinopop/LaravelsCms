<?php
/**
 * Created by PhpStorm.
 * User: 30557
 * Date: 2018/12/4
 * Time: 16:36
 */
namespace App\Http\Controllers\Admin\Customs;
use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\MaterialDict;
use App\Model\Admin\SeaportDict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CustomsSplitController extends BaseController{
    //模块名称
    protected $title = "单据拆分";
    //模块详情页名称
    protected $detailTitle = "单据拆分详情";
    //页面空间
    protected $bladePrefix = 'admin.customs.customsSplit';
    //控制器需要的模型
    protected $model = \App\Model\Admin\CustomsOrder::class;
    /*
     * 拆单页面
     * */
    public function index(){
        //全国口岸字典获取
        $seaPort = SeaportDict::where([
            'enable'=>'Y',
            'is_del'=>'N'
        ])->get();
        //物料分类字典获取
        $material = MaterialDict::where([
            'enable'=>'Y',
            'is_del'=>'N'
        ])->get();
        return view('admin.customs.customsSplit.index',[
            'prefix'=>$this->getControllerPrefix(),
            'title'=>$this->title,
            'seaPort'=>$seaPort,
            'material'=>$material
        ]);
    }

    /*
     * 拆单结果保存
     * */
    public function splitSave(Request $request){
        $reArray = Input::get('reArray');
        $i = DB::table('cm_customs_order')->insert($reArray);
        if($i){
            return [
                'code' => 200,
                'msg'=> '保存成功,请到编辑页面内查看'
            ];
        }else{
            return [
                'code' => 500,
                'msg'=> '保存失败'
            ];
        }
    }

    /*
     * 进口编辑页面
     * */
    public function edit(){
        return view('admin.customs.customsSplit.edit');
    }

    /*
     * 获取进口数据
     * */
    public function getData() : array {
        return [

        ];
    }
}