<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = false;
    protected $table = 'projects';
    protected $fillable = ['proj_name', 'start_date', 'total_cost','proj_owner', 'proj_engineer', 'description'];
}
