<?php

namespace App\DataEntity;

use Illuminate\Database\Eloquent\Model;

class ProjectStar extends Model
{
    protected $table = 'project_star';

    protected $primaryKey = ['uid', 'pid'];

    public $timestamps = false;

    public $incrementing = false;
}