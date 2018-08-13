<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/18
 * Time: 16:07
 */
namespace App\Model\Admin;
use Illuminate\Database\Eloquent\Model;
class Group extends Model{
    protected $table = 'cm_group';
    protected $primaryKey = 'id';
    public $timestamps = false;
}