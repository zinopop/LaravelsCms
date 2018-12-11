<?php
/**
 * Created by PhpStorm.
 * User: 30557
 * Date: 2018/11/9
 * Time: 10:14
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class ConsignorDict extends BaseModel{
    protected $table = 'cm_consignor_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}