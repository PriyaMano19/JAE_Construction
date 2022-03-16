<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    protected $table = 'employees';
    protected $fillable = ['emp_name', 'contact_no', 'NIC','Skills','Amount'];
    
}
