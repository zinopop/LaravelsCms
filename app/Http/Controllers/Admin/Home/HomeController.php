<?php
namespace App\Http\Controllers\Admin\Home;
use App\Http\Controllers\Admin\BaseController;
use App\Model\Admin\Group;
use App\Model\Admin\Route;
use App\Model\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class HomeController extends BaseController{
    public function index(Request $request){
        $menuList = $this->_getMenuList($request->session()->get('users'));
        return view('admin.home.index',['menuList'=>$menuList,'users'=>$request->session()->get('users')]);
    }



    /*
     * 获取左侧菜单列表
     *
     * */
    protected function _getMenuList($userMsg){
        //第一步先获取登陆用户的信息其中包括用户的左侧菜单数组
        $userId = $userMsg['id'];
        if(Redis::exists("user:role:".$userId)){
            $roleData = json_decode(Redis::command('get',['user:role:'.$userId]),true);
        }else{
            //走mysql并将数据存到redis中
            $roleData = $this->__getUserRoleDataForDataBase($userMsg);
        }
        return $this->__getListTree($roleData,0);
    }


    /*
     * 菜单数据处理
     * */
    protected function __getListTree($roleData,$pid){
        $tree = [];
        if(!empty($roleData)){
            foreach ($roleData as $k => $v){
                if($v['parent_id'] == $pid){
                    $v['son_data'] = $this->__getListTree($roleData,$v['id']);
                    $tree[] = $v;
                }
            }
        }
        return $tree;
    }


    /*
     * 通过数据库查询用户的权限信息
     * */
    protected function __getUserRoleDataForDataBase($userMsg){
        $userId = $userMsg['id'];
        $userData = User::where([
            'id'=>$userId
        ])->select(
            'group_set'
        )->first();
        $group_set_array = json_decode($userData->group_set,true);
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
                ])->whereIn('route_type',['menu','main_menu'])->get()->toJson();
                Redis::command('set',['user:role:'.$userId,$role_data]);
//                Redis::command('SADD',['user:route:'.$userId,$role_data->route_as]);
                $role_data = json_decode($role_data,true);
            }else{
//                return redirect()->route('admin.error.index')->with('msg','没有权限查看');
                $role_data = [];
            }
        }else{
//            return redirect()->route('admin.error.index')->with('msg','没有权限查看');
            $role_data = [];
        }
        return $role_data;

    }

    /*
     * 用户头像修改页面
     * */
    public function editAvatar(Request $request){
        return view('admin.home.home.editAvatar');
    }
    /*
     * 用户头像上传接口
     * */
    public function uploadAvatar(Request $request){
        $fileCharater = $request->file('file');
        try {
            if($fileCharater->isValid()){
                $ext = $fileCharater->getClientOriginalExtension();
                $path = $fileCharater->getRealPath();
                $filename = date('Y-m-d-h-i-s').'.'.$ext;
                $i = Storage::disk('imuploadImg')->put($filename, file_get_contents($path));
                if($i){
                    $user = User::find($request->session()->get('users')['id']);
                    $data = [
                        'avatar'=>Storage::disk('imuploadImg')->url($filename)
                    ];
                    $obj = $this->hanldUpdateDatabase($user,$data,$request->session()->get('users'));
                    $save = $obj->save();
                    if($save){
                        return [
                            'code'=>0,
                            'msg'=>'图片上传成功',
                            'data'=>[
                                'src'=>Storage::disk('imuploadImg')->url($filename)
                            ]
                        ];
                    }else{
                        return [
                            'code' => 500,
                            'msg' => '保存失败'
                        ];
                    }
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

}