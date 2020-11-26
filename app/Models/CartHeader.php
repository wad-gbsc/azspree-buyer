<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartHeader extends Model
{
    protected $table = 'srhr';
    protected $primaryKey = 'srhr_hash';
    public $timestamps = false;
}
