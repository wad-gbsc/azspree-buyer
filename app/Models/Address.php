<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addr';
    protected $primaryKey = 'addr_hash';
    public $timestamps = false;
}
