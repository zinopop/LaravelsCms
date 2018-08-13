<?php
namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller{
    public function index(Request $request,$id){
        //$request->session()->push('user.teams', 'developers');
        //$request->session()->forget('user');
        $request->session()->put('yuzheng', '123');
        $data = session('yuzheng');
       // $data = $request->session()->all();
        //$value = $request->session()->pull('key', 'default');
        return $data;
    }
}
