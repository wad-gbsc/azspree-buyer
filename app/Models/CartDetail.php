<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $table = 'srln';
    protected $primaryKey = 'srln_hash';
    public $timestamps = false;
}
