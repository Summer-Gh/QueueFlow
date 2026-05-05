<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class agent extends Model
{
    protected $table = 'agent'; // MUST match table name
    protected $primaryKey = 'idUser';
    public $timestamps = false;
}