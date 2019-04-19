<?php

namespace App\DataEntity;

use Illuminate\Database\Eloquent\Model;

class ProjectDeveloper extends Model
{
    protected $table = 'project_developer';

    protected $primaryKey = ['uid', 'pid'];

    public $timestamps = false;

    public $incrementing = false;
}