<?php
/**
 * Created by PhpStorm.
 * User: 30557
 * Date: 2018/11/29
 * Time: 9:51
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

interface CommonActionInterface{
    //todo 单档操作的首页
    public function index();
    //todo 单档操作的详情页
    public function detail(Request $request);
    //todo 获取数据包括分页功能
    public function getData(Request $request);
    //todo 数据保存功能
    public function save(Request $request);
    //todo 数据删除功能
    public function del();
}