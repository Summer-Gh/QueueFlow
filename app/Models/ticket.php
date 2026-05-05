<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    protected $table = 'ticket';
    protected $primaryKey = 'idTicket';
    public $timestamps = false;

    protected $fillable = [
        'tempsEstime',
        'position',
        'idFile'
    ];
}