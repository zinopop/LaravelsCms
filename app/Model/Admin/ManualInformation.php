<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/18
 * Time: 16:07
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class ManualInformation extends BaseModel{
    protected $table = 'cm_manual_information';
    protected $primaryKey = 'id';
    public $timestamps = false;
}