<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/19
 * Time: 15:48
 */
namespace App\Http\Controllers\Admin\Home;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class DefaultController extends BaseController{
    public function index(){
        return view('admin.home.default.index');
    }
}