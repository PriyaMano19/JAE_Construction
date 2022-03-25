<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    public $timestamps = false;
    protected $table = 'proj_budgets';
    protected $fillable = ['proj_id', 'budg_version','complete'];
}
