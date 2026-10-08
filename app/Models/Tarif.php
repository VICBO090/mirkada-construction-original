<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'libelle', 'description', 'prix', 'unite', 'categorie'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}