<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicule;

class VehiculeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicules = [
            [
                'immatriculation' => '123TUN456',
                'marque' => 'Peugeot',
                'modele' => '208',
                'couleur' => 'Blanc',
                'annee' => 2020,
                'kilometrage' => 45000,
                'carrosserie' => 'Berline',
                'energie' => 'Essence',
                'boite' => 'Manuelle'
            ],
            [
                'immatriculation' => '789TUN012',
                'marque' => 'Renault',
                'modele' => 'Clio',
                'couleur' => 'Rouge',
                'annee' => 2019,
                'kilometrage' => 62000,
                'carrosserie' => 'Citadine',
                'energie' => 'Diesel',
                'boite' => 'Automatique'
            ],
            [
                'immatriculation' => '345TUN678',
                'marque' => 'Toyota',
                'modele' => 'Corolla',
                'couleur' => 'Gris',
                'annee' => 2021,
                'kilometrage' => 28000,
                'carrosserie' => 'Berline',
                'energie' => 'Hybride',
                'boite' => 'Automatique'
            ],
            [
                'immatriculation' => '901TUN234',
                'marque' => 'Volkswagen',
                'modele' => 'Golf',
                'couleur' => 'Noir',
                'annee' => 2018,
                'kilometrage' => 78000,
                'carrosserie' => 'Compacte',
                'energie' => 'Essence',
                'boite' => 'Manuelle'
            ],
            [
                'immatriculation' => '567TUN890',
                'marque' => 'BMW',
                'modele' => 'Serie 3',
                'couleur' => 'Bleu',
                'annee' => 2022,
                'kilometrage' => 15000,
                'carrosserie' => 'Berline',
                'energie' => 'Diesel',
                'boite' => 'Automatique'
            ]
        ];

        foreach ($vehicules as $vehicule) {
            Vehicule::create($vehicule);
        }
    }
}