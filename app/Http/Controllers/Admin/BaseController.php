<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/19
 * Time: 9:36
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*
     * 错误页面跳转
     * */
    public function redirectErrorPage($ErrorMsg,$timeout,$redirectUrl,$clearSession = true){
        if($clearSession == true){

        }else{

        }
    }

    /*
     * 获取当前控制器内路由别名统一前缀
     * */
    public function getControllerPrefix(){
        $preifx = "";
        if(!empty(request()->route()->getAction())){
            $preifxArray = request()->route()->getAction();
            $preifx = preg_replace('/(.*)\.([^\/]*)/i', '$1', $preifxArray['as']);
        }
        return $preifx;
    }

    /*
     * bootstrap table返回数据处理
     * */
    public function responseBootData($data = [],$count = 0){
        return [
            'total'=>$count,
            'rows'=>$data
        ];
    }

    /*
     * 获取enum类型中所有值
     * */
    public function getEnumData($table,$columns){
        $data = [];
        $results = DB::select("SHOW COLUMNS FROM `".$table."` LIKE '".$columns."'");
        $route_type_array = [];
        preg_match_all("/(?:\()(.*)(?:\))/i",$results[0]->Type, $route_type_array);
        $route_type_array = explode(',',$route_type_array[1][0]);
        if (!empty($route_type_array)){
            foreach ($route_type_array as $k => $v){
                $r = array();
                preg_match_all("/(?:')(.*)(?:')/i",$v, $r);
                array_push($data,$r[1][0]);
            }
        }
        return $data;
    }

    /*
     * 处理入库数据
     * */
    public function hanldInsertDatabase($obj,$data,$sesson){
        foreach ($data as $k => $v){
            $obj->$k = $v;
        }
        $obj->create_user = $sesson['user'];
        $obj->create_time = date('Y-m-d H:i:s');
        $obj->update_user = $sesson['user'];
        $obj->update_time = date('Y-m-d H:i:s');
        return $obj;
    }

    /*
     * 更新数据
     * */
    public function hanldUpdateDatabase($obj,$data,$sesson){
        foreach ($data as $k => $v){
            $obj->$k = $v;
        }
        $obj->update_user = $sesson['user'];
        $obj->update_time = date('Y-m-d H:i:s');
        return $obj;
    }

}