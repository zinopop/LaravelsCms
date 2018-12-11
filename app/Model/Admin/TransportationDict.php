<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 15:26
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class TransportationDict extends BaseModel{
    protected $table = 'cm_transportation_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}