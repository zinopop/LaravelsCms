<?php
/**
 * Created by yuzheng.
 * User: yuzheng
 * Date: 2018/7/10
 * Time: 10:05
 */
namespace App\Http\Controllers\Admin\Login;
use App\Http\Controllers\Admin\BaseController;
use App\Jobs\TestQue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\User;


class LoginController extends BaseController{
    public function index(Request $request){
//        for ($i=0;$i<=500000;$i++){
//            TestQue::dispatch("于政")->onQueue('test1');
//        }
        return view('admin.login.index');
    }

    /*
     * 登陆动作
     * */
    public function login(Request $request){
        $user = User::where([
            'user'=>$request->input('user'),
            'password'=>md5($request->input('password')),
            'enable'=>'Y',
            'is_del'=>'N'
        ])->select(
            'id','user','nickname','avatar','sign','group_set'
        )->first();
        if(!empty($user)){
            $request->session()->put('users', $user->toArray());

            if($request->session()->has('users')){
                return [
                    'code'=>200,
                    'msg'=>'登陆成功'
                ];
            }else{
                return [
                    'code'=>500,
                    'msg'=>'登陆异常'
                ];
            }
        }else{
            return [
                'code'=>500,
                'msg'=>'登陆失败,请联系管理员'
            ];
        }

    }


    /*
     * 登出动作
     * */
    public function logout(Request $request){
        $request->session()->forget('users');
        return redirect()->route('admin.login.index');
    }
}