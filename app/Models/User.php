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
        'mdp'
    ];

    // relation → utilisateur (telephone)
    public function utilisateur()
    {
        return $this->hasOne(Utilisateurs::class, 'idUser');
    }

    // relation → tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'idUser');
    }
}