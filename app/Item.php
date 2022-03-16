<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;
    protected $table = 'items';
    protected $fillable = ['item_name', 'item_description', 'cat_code'];
}
