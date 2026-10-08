<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'titre' => 'Construction générale',
                'slug' => 'construction-generale',
                'description_courte' => 'Maisons, écoles, églises, centres de santé et bâtiments administratifs.',
                'ordre' => 1,
            ],
            [
                'titre' => 'Conception architecturale',
                'slug' => 'conception-architecturale',
                'description_courte' => 'Études, devis, plans et maquettes pour donner forme à votre projet.',
                'ordre' => 2,
            ],
            [
                'titre' => 'Électricité générale',
                'slug' => 'electricite-generale',
                'description_courte' => 'Installation électrique, éclairage et dépannage.',
                'ordre' => 3,
            ],
            [
                'titre' => 'Plomberie',
                'slug' => 'plomberie',
                'description_courte' => 'Installation sanitaire, conduites et robinetterie.',
                'ordre' => 4,
            ],
            [
                'titre' => 'Charpente métallique et bois',
                'slug' => 'charpente',
                'description_courte' => 'Charpente, hangars, galeries, plafond et décoration.',
                'ordre' => 5,
            ],
            [
                'titre' => 'Peinture, carrelage & rénovation',
                'slug' => 'peinture-carrelage-renovation',
                'description_courte' => 'Peinture, carrelage et achèvement de maisons et bâtiments.',
                'ordre' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}