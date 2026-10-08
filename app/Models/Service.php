<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'description_courte',
        'description_longue',
        'image',
        'icone',
        'ordre',
    ];

    public function tarifs()
    {
        return $this->hasMany(Tarif::class);
    }
}