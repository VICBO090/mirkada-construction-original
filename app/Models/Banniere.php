<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banniere extends Model
{
    use HasFactory;

    protected $fillable = ["titre", "sous_titre", "image", "lien", "ordre", "actif"];

    protected $casts = [
        "actif" => "boolean",
    ];
}
