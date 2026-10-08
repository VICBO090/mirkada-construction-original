<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    public function run(): void
    {
        Entreprise::create([
            'nom' => 'Mirkada Construction',
            'telephone' => '+243 976 501 066',
            'email' => 'mirkadaconstruction@mail.com',
            'adresse' => '8 Musumba, Katuba — Lubumbashi',
        ]);
    }
}