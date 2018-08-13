<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BaseController;
class ErrorController extends BaseController{
    public function index(){
        return view('admin.error.index');
    }
}