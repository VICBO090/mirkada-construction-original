<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    protected $fillable = ['chemin', 'jour', 'total'];

    protected $casts = [
        'jour' => 'date',
    ];
}
