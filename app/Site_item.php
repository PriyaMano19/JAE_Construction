<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_item extends Model
{
    public $timestamps = false;
    protected $table = 'site_item';
    protected $fillable = ['item_id', 'qty','unit_price'];
}
