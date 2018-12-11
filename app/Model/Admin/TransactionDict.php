<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 14:52
 */
namespace App\Model\Admin;
use App\Model\BaseModel;
class TransactionDict extends BaseModel{
    protected $table = 'cm_transaction_dict';
    protected $primaryKey = 'id';
    public $timestamps = false;
}