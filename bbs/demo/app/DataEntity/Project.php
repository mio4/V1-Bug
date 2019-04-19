<?php

namespace App\DataEntity;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';

    protected $primaryKey = 'pid';

    protected $fillable = [
        'project_name',
        'project_owner',
        'project_info',
        'project_kind',
        'project_reward',
        'project_photo',
        'participant_max',
        'project_createTime',
    ];

    public $timestamps = false;
}
