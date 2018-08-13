<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/23
 * Time: 13:43
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\Group;
use App\Model\Admin\Route;
use App\Model\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;


class UserController extends BaseController{
    /*
     * 用户列表
     * */
    public function userList(){
        return view('admin.user.userList');
    }


    /*
     * 获取用户列表数据
     * */
    public function getUserData(Request $request){
        $group = Group::select('id','group_name')->get()->toArray();
        $group_op = [];
        if(!empty($group)){
            foreach ($group as $k => $v){
                $group_op[$v['id']] = $v['group_name'];
            }
        }
        $where = [
            'is_del' => 'N',
        ];
        if(!empty($request->input('user'))) $where[] = ['user','like','%'.$request->input('user').'%'];
        $data = User::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        foreach ($data as $k => $v){
            $data[$k]['group_op'] = $group_op;
        }
        $count = User::where($where)->count();
        return $this->responseBootData($data,$count);
    }

    /*
     * 用户新增页
     * */
    public function userDetailAdd(){
        $data = [];
        $group = Group::select('id','group_name')->where([
            'enable' => 'Y'
        ])->get()->toArray();
        if(empty(Input::get('id'))){
            $data['group'] = $group;
        }else{
            $user = User::where([
                'id'=>Input::get('id')
            ])->first();
            $data['group'] = $group;
            $data['user'] = $user->toArray();
        }
        return view('admin.user.userDetail',['data'=>$data]);
    }

    /*
     * 用户数据保存
     * */
    public function userDataSave(Request $request){
        if($request->input('submit_type') == 'add'){
            //新增数据
            $data = Input::except(['id','_token','submit_type']);
            if(empty($data['group_set'])){
                $data['group_set'] = '[]';
            }else{
                $data['group_set'] = json_encode($data['group_set']);
            }
            $userobj = User::select('id')->where([
                'user'=>$data['user']
            ])->first();
            if(!empty($userobj)){
                return [
                    'code'=>500,
                    'msg'=>'账户已存在'
                ];
            }
            $user = new User;
            $obj = $this->hanldInsertDatabase($user,$data,$request->session()->get('users'));
            $i = $obj->save();
            if($i){
                return [
                    'code'=>200,
                    'msg'=>'保存成功'
                ];
            }else{
                return [
                    'code' => 500,
                    'msg' => '保存失败'
                ];
            }
        }else if($request->input('submit_type') == 'edit'){
            //编辑数据
            $data = Input::except(['id','_token','submit_type']);
            if(empty($data['group_set'])){
                $data['group_set'] = '[]';
            }else{
                $data['group_set'] = json_encode($data['group_set']);
            }
            $user = User::find(Input::get('id'));
            $obj = $this->hanldUpdateDatabase($user,$data,$request->session()->get('users'));
            $i = $obj->save();
            if($i){
                Redis::del('user:role:'.Input::get('id'));
                Redis::del('user:route:'.Input::get('id'));
                return [
                    'code'=>200,
                    'msg'=>'保存成功'
                ];
            }else{
                return [
                    'code' => 500,
                    'msg' => '保存失败'
                ];
            }
        }
    }

    /*
     * 用户数据删除
     * */
    public function userDataDel(){
        $data = Input::except(['_token']);
        $up_data = [];
        foreach ($data['idArray'] as $k => $v){
            array_push($up_data,[
                'id'=>$v,
                'is_del'=>'Y'
            ]);
        }
        if(app(User::class)->updateBatch($up_data) != false){
            foreach ($data['idArray'] as $k => $v){
                Redis::del('user:role:'.$v);
                Redis::del('user:route:'.$v);
            }
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
     * 权限组
     * */
    public function roleGroupList(){
        return '权限组列表';
    }

    /*
     * 权限组子菜单测试
     * */
    public function roleGroupListSon(){
        return '权限组子菜单测试';
    }

    /*
     * 角色列表
     * */
    public function roleList(){
        return view('admin.user.roleList');
    }

    /*
     * 获取角色列表数据
     * */
    public function getRoleListData(Request $request){
        $where = [];
        if(!empty($request->input('group_name'))) $where[] = ['group_name','like','%'.$request->input('group_name').'%'];
        $data = Group::where($where)->offset($request->input('offset'))->limit($request->input('limit'))->get()->toArray();
        $count = Group::select('id')->where($where)->count();
        return $this->responseBootData($data,$count);
    }

    /*
     * 角色详情页
     * */
    public function roleDetail(Request $request){
        $data = [];
        if(!empty($request->input('id'))){
            $data['group_data'] = Group::select('id','group_name')->where([
                'id'=>$request->input('id')
            ])->first()->toArray();
        }
        return view('admin.user.roleDetail',['data'=>$data]);
    }

    /*
     * 角色数据保存
     * */
    public function roleDataSave(Request $request){
        $user = User::select('id')->get()->toArray();
        if($request->input('submit_type') == 'edit'){
            //编辑
            $group = Group::find($request->input('id'));
            $group->group_name = $request->input('group_name');
            $group->route_set = !empty($request->input('route_set')) ? json_encode($request->input('route_set')) : '[]';
            $group->update_user = $request->session()->get('users')['user'];
            $group->update_time = date('Y-m-d H:i:s');
            $i = $group->save();
            if($i){
                foreach ($user as $k => $v){
                    Redis::del('user:role:'.$v['id']);
                    Redis::del('user:route:'.$v['id']);
                }
                return [
                    'code'=>200,
                    'msg'=>'保存成功'
                ];
            }else{
                return [
                    'code' => 500,
                    'msg' => '保存失败'
                ];
            }
        }else if($request->input('submit_type') == 'add'){

            $group = new Group;
            $data = Input::except(['_token','submit_type']);
            $data['route_set'] = isset($data['route_set'])? json_encode($data['route_set']) : '[]';
            $obj = $this->hanldInsertDatabase($group,$data,$request->session()->get('users'));
            $i = $obj->save();
            if($i){
                return [
                    'code'=>200,
                    'msg'=>'保存成功'
                ];
            }else{
                return [
                    'code' => 500,
                    'msg' => '保存失败'
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
     * 获取路由数据接口
     * */
    public function getRuteData(Request $request){
        if(empty($request->input('groupId'))){
            return Route::select('id','parent_id as pId','route_name as name')->whereNotIn('route_type',[
                'other'
            ])->where([
                'enable'=>'Y',
                'is_del'=>'N'
            ])->get()->toArray();
        }else{
            $result = Route::select('id','parent_id as pId','route_name as name')->whereNotIn('route_type',[
                'other'
            ])->where([
                'enable'=>'Y',
                'is_del'=>'N'
            ])->get()->toArray();
            $route_set = Group::select('route_set')->where([
                'id'=>$request->input('groupId')
            ])->first()->toArray();
            $route_set = json_decode($route_set['route_set']);
            foreach ($result as $k => $v){
                if(in_array($v['id'],$route_set)){
                    $result[$k]['checked'] = true;
                    $result[$k]['open'] = true;
                }
            }
            return $result;
        }
    }

}