<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/3
 * Time: 8:58
 */
namespace App\Http\Controllers\Admin\Im;
use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\Group;
use App\Model\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class TestContrller extends BaseController{
    public function index(Request $request){
        $users = $request->session()->get('users');
        return view('admin.im.test.index',['users'=>$users]);
    }
    /*
     * 获取好友列表
     * */
    public function getFriendList(Request $request){
        $friend_and_group = $this->_getUserList($request);
        $mine = $this->_getMineData($request);
        return [
            'code'=>0,
            'msg'=>'获取成功',
            'data'=>[
                'mine'=>$mine,
                'friend'=>$friend_and_group['friend'],
                'group'=>$friend_and_group['group']
            ]
        ];
    }

    /*
     * 获取用户数据
     * */
    public function _getUserList($request){

        $data = [];
        $group = Group::select('id','group_name as groupname','group_avatar as avatar')->get()->toArray();
        $user = User::select('id','nickname as username','avatar','sign','online_status as status','group_set','user')->where([
            'enable'=>'Y',
            'is_del'=>'N'
        ])->get()->toArray();
        $data['group']=$group;

        foreach ($group as $k => $v){
            $list = [];
            foreach ($user as $k2 => $v2){
                if(in_array($v['id'],json_decode($v2['group_set'])) && $request->session()->get('users')['id'] != $v2['id']){
                    array_push($list,$v2);
                    unset($user[$k2]);
                }
            }
            $group[$k]['list'] = $list;
        }

        $group_new = [];
        if(!empty(json_decode($request->session()->get('users')['group_set']))){
            foreach ($data['group'] as $k => $v){
                if(in_array($v['id'],json_decode($request->session()->get('users')['group_set']))){
                    array_push($group_new,$data['group'][$k]);
                }
            }

            $data['group'] = $group_new;
        }else{
            $data['group'] = [];
        }

        $data['friend']=$group;
        return $data;
    }

    /*
     * 获取登陆人的信息
     * */
    public function _getMineData($request){
        $session_user = $request->session()->get('users');
        $user = User::select('id','nickname as username','online_status as status','sign','avatar')->where([
            'id'=>$session_user['id']
        ])->get()->first()->toArray();
        $user['status'] = 'online';
        return $user;
    }

    /*
     * 聊天图片上传接口
     * */
    public function uploadImg(Request $request){
        $fileCharater = $request->file('file');
        try {
            if($fileCharater->isValid()){
                $ext = $fileCharater->getClientOriginalExtension();
                $path = $fileCharater->getRealPath();
                $filename = date('Y-m-d-h-i-s').'.'.$ext;
                $i = Storage::disk('imuploadImg')->put($filename, file_get_contents($path));
                if($i){
                    return [
                        'code'=>0,
                        'msg'=>'图片上传成功',
                        'data'=>[
                            'src'=>Storage::disk('imuploadImg')->url($filename)
                        ]
                    ];
                }else{
                    return [
                        'code'=>500,
                        'msg'=>'图片上传失败',
                        'data'=>[
                            'src'=>''
                        ]
                    ];
                }

            }
        }catch (\Exception $e){
            return [
                'code'=>500,
                'msg'=>'被抛出了异常'.$e,
                'data'=>[
                    'src'=>''
                ]
            ];
        }
    }
    /*
     * 聊天文件上传接口
     * */
    public function uoloadFile(Request $request){
        $fileCharater = $request->file('file');
        try {
            if($fileCharater->isValid()){
                $rawname = $fileCharater->getClientOriginalName();
                $ext = $fileCharater->getClientOriginalExtension();
                $path = $fileCharater->getRealPath();
                $filename = date('Y-m-d-h-i-s').'.'.$ext;
                $i = Storage::disk('imuploadFile')->put($filename, file_get_contents($path));
                if($i){
                    return [
                        'code'=>0,
                        'msg'=>'文件上传成功',
                        'data'=>[
                            'src'=>Storage::disk('imuploadFile')->url($filename),
                            'name'=>$rawname
                        ]
                    ];
                }else{
                    return [
                        'code'=>500,
                        'msg'=>'文件上传失败',
                        'data'=>[
                            'src'=>''
                        ]
                    ];
                }
            }
        }catch (\Exception $e){
            return [
                'code'=>500,
                'msg'=>'被抛出了异常'.$e,
                'data'=>[
                    'src'=>''
                ]
            ];
        }
    }

    /*
     * 查看群成员接口by id
     * */
    public function getGroupUserList(Request $request){
        try {
            $group_user = [];
            $id = $request->input('id');
            $user = User::select('nickname as username','id','avatar','sign','group_set')->where([
                'enable'=>'Y',
                'is_del'=>'N'
            ])->get()->toArray();
            if(!empty($user)){
                foreach ($user as $k => $v){
                    if(in_array($id,json_decode($v['group_set']))){
                        array_push($group_user,$v);
                    }
                }
            }
            return [
                'code'=>0,
                'msg'=>'成功',
                'data'=>[
                    'list'=>$group_user
                ]
            ];
        }catch (\Exception $exception){
            return [
                'code'=>500,
                'msg'=>'被抛出了异常'.$exception,
                'data'=>[
                    'src'=>''
                ]
            ];
        }

    }

    /*
     * im更新好友状态接口
     * */
    public function updateUserStatus(Request $request){
        $user = User::find(Input::get('id'));
        $data = Input::except(['id','_token']);
        $obj = $this->hanldUpdateDatabase($user,$data,$request->session()->get('users'));
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
    }

    /*
     * im用户签名修改接口
     * */
    public function updateUserSign(Request $request){
        $user = User::find(Input::get('id'));
        $data = Input::except(['id','_token']);
        $obj = $this->hanldUpdateDatabase($user,$data,$request->session()->get('users'));
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
    }

    /*
     * im历史纪录查询页面
     * */
    public function chatLog(Request $request){
        return view('admin.im.test.chatLog');
    }
}