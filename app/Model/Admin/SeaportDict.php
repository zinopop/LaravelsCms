<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 11:17
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class SeaportDict extends BaseModel{
    protected $table = 'cm_seaport_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}