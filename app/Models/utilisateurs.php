<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateurs extends Model
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'idUser';
    public $timestamps = false;

    protected $fillable = [
        'idUser',
        'Telephone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}