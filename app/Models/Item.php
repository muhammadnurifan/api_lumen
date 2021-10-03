<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Item extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'items';
    protected $primaryKey = '_id';

    protected $fillable = ['item_code', 'item_name', 'uom'];
}
