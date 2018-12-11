<?php
/**
 * Created by PhpStorm.
 * User: 30557
 * Date: 2018/11/27
 * Time: 14:02
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class AgencyShopServicer extends BaseModel{
    protected $table = 'cm_agency_shop_servicer';
    protected $primaryKey = 'id';
    public $timestamps = false;
}