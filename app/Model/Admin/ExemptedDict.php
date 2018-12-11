<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 9:24
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class ExemptedDict extends BaseModel{
    protected $table = 'cm_exempted_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}