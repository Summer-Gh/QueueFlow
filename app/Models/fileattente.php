<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fileattente extends Model
{
    protected $table = 'fileattente';
    protected $primaryKey = 'idFile';
    public $timestamps = false;

    protected $fillable = [
        'nomFile',
        'capacite',
        'idService'
    ];
}