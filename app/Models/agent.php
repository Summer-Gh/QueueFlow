<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = 'agent';
    protected $primaryKey = 'idUser';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}