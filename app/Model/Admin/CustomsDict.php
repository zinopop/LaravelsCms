<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10
 * Time: 16:25
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class CustomsDict extends BaseModel{
    protected $table = 'cm_customs_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}