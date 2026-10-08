<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = ["nom", "description", "image", "date_obtention"];

    protected $casts = [
        "date_obtention" => "date",
    ];
}
