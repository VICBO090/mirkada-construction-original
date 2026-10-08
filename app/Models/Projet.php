<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'lieu',
        'client',
        'type_projet',
        'date_debut',
        'date_fin',
        'etat_avancement',
        'image_principale',
        'photos',
        'service_id',
    ];

    protected $casts = [
        'photos' => 'array',
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}