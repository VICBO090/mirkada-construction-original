<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'accroche_titre', 'accroche_texte', 'logo',
        'histoire', 'vision', 'mission', 'valeurs',
        'telephone', 'email', 'adresse',
        'nb_projets_realises', 'annees_experience',
    ];
}
