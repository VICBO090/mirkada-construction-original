<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'slug', 'extrait', 'contenu', 'image', 'type', 'publie_le'];

    protected $casts = ['publie_le' => 'date'];
}