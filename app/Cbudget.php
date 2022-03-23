<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cbudget extends Model
{
    public $timestamps = false;
    protected $table = 'cate_budget';
    protected $fillable = ['budg_id', 'cate_id','Amount'];
}
