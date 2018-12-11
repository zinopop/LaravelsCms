<?php
/**
 * Created by PhpStorm.
 * User: 30557
 * Date: 2018/12/10
 * Time: 16:02
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class CustomsOrder extends BaseModel{
    protected $table = 'cm_customs_order';
    protected $primaryKey = 'id';
    public $timestamps = false;
}