<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 2019/4/6
 * Time: 10:21
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}