<?php

namespace App\DataEntity;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $primaryKey = 'uid';

    protected $fillLabel = [
        'user_email',
        'password',
        'user_kind',
        'user_name'
    ];
}
