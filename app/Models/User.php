<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'idUser';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'email',
        'motDePasse'
    ];
}