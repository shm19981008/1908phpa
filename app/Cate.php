<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
      protected $table = 'category';
      protected $primaryKey='cate_id';
    protected $guarded=[];
    public $timestamps=false;

}
