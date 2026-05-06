<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'idService';
    public $timestamps = false;

    protected $fillable = [
        'nomService',
        'description',
        'idUser'
    ];

    // ONE file per service
    public function fileAttente()
    {
        return $this->hasOne(FileAttente::class, 'idService');
    }

    // creator (agent)
    public function agent()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}