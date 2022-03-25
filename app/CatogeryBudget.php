<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatogeryBudget extends Model
{
    protected $table = 'category_budget';
    protected $fillable = ['budget_id', 'catogery_id','amount'];
}
