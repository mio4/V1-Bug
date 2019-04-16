<?php

namespace App\DataEntity;

use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    protected $table = 'user_project';
    protected $primaryKey = 'up_id';

    protected $fillable = array(
        'uid',
        'pid'
    );

    public $timestamps = false;
}
