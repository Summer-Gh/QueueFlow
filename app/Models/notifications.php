<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'idNotification';
    public $timestamps = false;

    protected $fillable = [
        'message',
        'idUser'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}