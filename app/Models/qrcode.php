<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class qrcode extends Model
{
    protected $table = 'qrcode';
    protected $primaryKey = 'idQR';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'statut',
        'idTicket'
    ];
}