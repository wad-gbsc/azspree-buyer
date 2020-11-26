<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHeader extends Model
{
    protected $table = 'sohr';
    protected $primaryKey = 'sohr_hash';
    public $timestamps = false;
}
