<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 16:01
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class UnitDict extends BaseModel{
    protected $table = 'cm_unit_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}