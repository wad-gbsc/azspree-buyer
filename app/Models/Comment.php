<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'cmnt';
    protected $primaryKey = 'cmnt_hash';
    public $timestamps = false;
}
