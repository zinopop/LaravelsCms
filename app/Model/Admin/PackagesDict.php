<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/2
 * Time: 9:28
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class PackagesDict extends BaseModel{
    protected $table = 'cm_packages_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}