<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Tarif;
use Illuminate\Database\Seeder;

class TarifSeeder extends Seeder
{
    public function run(): void
    {
        $construction = Service::where('slug', 'construction-generale')->first();

        if (! $construction) {
            return;
        }

        $niveaux = [
            ['categorie' => 'Économique', 'libelle' => 'Construction générale - Économique', 'prix' => 250],
            ['categorie' => 'Standard', 'libelle' => 'Construction générale - Standard', 'prix' => 350],
            ['categorie' => 'Haut de gamme', 'libelle' => 'Construction générale - Haut de gamme', 'prix' => 500],
        ];

        foreach ($niveaux as $niveau) {
            Tarif::create([
                'service_id' => $construction->id,
                'libelle' => $niveau['libelle'],
                'categorie' => $niveau['categorie'],
                'prix' => $niveau['prix'],
                'unite' => 'm²',
            ]);
        }
    }
}