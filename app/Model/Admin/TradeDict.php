<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 14:17
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class TradeDict extends BaseModel{
    protected $table = 'cm_trade_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}