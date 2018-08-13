<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/18
 * Time: 16:47
 */
namespace App\Model\Admin;
use Illuminate\Database\Eloquent\Model;
class Route extends Model{
    protected $table = 'cm_route';
    protected $primaryKey = 'id';
    public $timestamps = false;
}