<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';
    protected $primaryKey = 'idTicket';
    public $timestamps = false;

    protected $fillable = [
        'position',
        'tempsEstime',
        'idFile',
        'idUser'
    ];

    // relation → file
    public function file()
    {
        return $this->belongsTo(FileAttente::class, 'idFile');
    }

    // relation → user
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}