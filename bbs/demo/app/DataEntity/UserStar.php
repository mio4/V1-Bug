<?php

namespace App\DataEntity;

use Illuminate\Database\Eloquent\Model;

class UserStar extends Model
{
    protected $table = 'user_star';
    protected $primaryKey = 'star_id';

    protected $fillable = array(
        'u1_id',
        'u2_id'
    );

    public $timestamps = false;
}
