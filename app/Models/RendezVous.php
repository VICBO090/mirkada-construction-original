<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    protected $table = 'rendez_vous';

    protected $fillable = ['nom', 'telephone', 'email', 'date_souhaitee', 'heure_souhaitee', 'sujet', 'statut'];

    protected $casts = ['date_souhaitee' => 'date'];
}