<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    use HasFactory;

    protected $fillable = ["nom_client", "poste_client", "contenu", "note", "photo", "approuve"];

    protected $casts = [
        "approuve" => "boolean",
        "note" => "integer",
    ];
}
