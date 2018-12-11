<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10
 * Time: 15:00
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class CountryDict extends BaseModel{
    protected $table = 'cm_country_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}