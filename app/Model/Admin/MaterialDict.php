<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 10:19
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class MaterialDict extends BaseModel{
    protected $table = 'cm_material_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}