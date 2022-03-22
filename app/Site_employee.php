<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_employee extends Model
{
    public $timestamps = false;
    protected $table = 'site_employee';
    protected $fillable = ['dsreport_id', 'emp_id','amount'];
}
