<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileAttente extends Model
{
    protected $table = 'fileattente';
    protected $primaryKey = 'idFile';
    public $timestamps = false;

    protected $fillable = [
        'nomFile',
        'capacite',
        'idService'
    ];

    // relation → service
    public function service()
    {
        return $this->belongsTo(Service::class, 'idService');
    }

    // relation → tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'idFile');
    }
}