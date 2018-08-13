<?php
/**
 * Created by 于政.
 * User: 于政
 * Date: 2018/7/10
 * Time: 15:02
 */
namespace App\Model\Admin;
//use Illuminate\Database\Eloquent\Model;
use App\Model\BaseModel;

class User extends BaseModel{
    protected $table = 'cm_user';
    protected $primaryKey = 'id';
    public $timestamps = false;
}