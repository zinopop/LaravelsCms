<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/19
 * Time: 15:50
 */
namespace App\Http\Middleware;
use App\Model\Admin\Group;
use App\Model\Admin\Route;
use App\Model\Admin\User;
use Closure;
use Illuminate\Support\Facades\Redis;

class RoleAuthAjax{
    public function handle($request, Closure $next){
        $users = $request->session()->get('users');
        if($this->_getUserRouteList($users,$request->route()->getAction()['as'])){
            return $next($request);
        }else{
            return response()->json([
                'code'=>500,
                'msg'=>'没有权限'
            ]);
        }
    }

    /*
    * 获得登陆用户id的权限组
    * */
    protected function _getUserRouteList($user,$as){

        //先到redis中寻找
        $userId = $user['id'];

        if(Redis::exists("user:route:".$userId)){
            if(!in_array($as,Redis::command('SMEMBERS',['user:route:'.$userId]))){
                return false;
            }else{
                return true;
            }
        }else{
            //去数据库查询
            $userData = User::where([
                'id'=>$userId
            ])->select(
                'group_set'
            )->first();
            $group_set_array = json_decode($userData->group_set,true);
            $role_data = [];
            if(!empty($group_set_array)){
                $group_data = Group::whereIn('id',$group_set_array)->where([
                    'enable'=>'Y'
                ])->get();
                if(!empty($group_data)){
                    //拼接权限菜单对象
                    $role_array = [];
                    foreach ($group_data as $k => $v){
                        $role_array = array_merge(json_decode($v->route_set,true),$role_array);
                    }
                    $role_array = array_unique($role_array);
                    $role_data = Route::whereIn('id',$role_array)->where([
                        'enable' => 'Y',
                        'is_del' => 'N'
                    ])->get()->toJson();
//                Redis::command('SADD',['user:route:'.$userId,$role_data->route_as]);
                    $role_data = json_decode($role_data,true);
                }
            }
            if(!empty($role_data)){
                foreach ($role_data as $k => $v){
                    Redis::command('SADD',['user:route:'.$userId,$v['route_as']]);
                }
                if(!in_array($as,Redis::command('SMEMBERS',['user:route:'.$userId]))){
                    return false;
                }else{
                    return true;
                }
            }else{
                return false;
            }
        }
    }
}