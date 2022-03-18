<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daily_site_report extends Model
{
    public $timestamps = false;
    protected $table = 'daily_site_report';
    protected $fillable = ['proj_id', 'cate_id','date'];
}
