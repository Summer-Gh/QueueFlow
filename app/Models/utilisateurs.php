<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class utilisateurs extends Model
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'idUser';
    public $timestamps = false;

    protected $fillable = [
        'idUser',
        'Telephone'
    ];
}