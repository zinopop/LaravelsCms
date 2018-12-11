<?php
/**
 * Created by PhpStorm.
 * User: 30557
 * Date: 2018/12/4
 * Time: 10:16
 */
namespace App\Imports;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class ManualInformationImport implements ToCollection{
    private $userSession;
    function __construct($user){
        $this->userSession = $user;
    }

    public function collection(Collection $rows){
        $insertArray = [];
        unset($rows[0]);
        foreach ($rows as $k => $v){
            array_push($insertArray,[
                'manual_num'=>$v[0],
                'style'=>$v[1],
                'num'=>$v[2],
                'goods_code'=>$v[3],
                'goods_name'=>$v[4],
                'format'=>$v[5],
                'amount'=>$v[6],
                'unit'=>$v[7],
                'price'=>$v[8],
                'total'=>$v[9],
                'country'=>$v[10],
                'create_user'=>$this->userSession['user'],
                'create_time'=>date('Y-m-d H:i:s'),
                'update_user'=>$this->userSession['user'],
                'update_time'=>date('Y-m-d H:i:s')
            ]);
        }
        DB::table('cm_manual_information')->insert($insertArray);
    }
}