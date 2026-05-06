<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    protected $table = 'qrcode';
    protected $primaryKey = 'idQrcode';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'idTicket'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'idTicket');
    }
}