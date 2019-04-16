<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class testModel extends Model
{
    protected $table = "user";
    public $timestamps = false;

    public function readAll(){
        return $this->all();
    }

    public function getOne($data,$arr){
        return $this->where($data,$arr)->get()->toArray();
    }
}
