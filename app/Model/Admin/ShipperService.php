<?php
/**
 * Created by PhpStorm.
 * User: 30557
 * Date: 2018/11/26
 * Time: 9:45
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class ShipperService extends BaseModel{
    protected $table = 'cm_shipper_service';
    protected $primaryKey = 'id';
    public $timestamps = false;
}