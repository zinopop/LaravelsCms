<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/2
 * Time: 9:28
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class CurrencyDict extends BaseModel{
    protected $table = 'cm_currency_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}