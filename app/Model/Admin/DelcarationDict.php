<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11
 * Time: 11:43
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class DelcarationDict extends BaseModel{
    protected $table = 'cm_delcaration_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}