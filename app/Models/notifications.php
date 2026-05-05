<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notifications extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'idNotif';
    public $timestamps = false;

    protected $fillable = [
        'message',
        'idTicket'
    ];
}