<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11
 * Time: 14:38
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class DestianationDict extends BaseModel{
    protected $table = 'cm_destianation_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}