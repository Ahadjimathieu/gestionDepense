<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\User;
use App\Models\Agent;
use App\Models\Client;
use App\Models\Prestataire;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Client::factory(20)->create();
        Agent::factory(20)->create();

        $prestataire1 = Prestataire::factory()->create([
            'nom' => 'Electricite',
        ]);
        $prestataire2 = Prestataire::factory()->create([
            'nom' => 'Eau',
        ]);
        $prestataire3 = Prestataire::factory()->create([
            'nom' => 'Loyer',
        ]);

        $type1 = Type::factory()->create([
            'nom' => 'Salaire',
        ]);
        $type2 = Type::factory()->create([
            'nom' => 'Prestataire',
        ]);
        $type3 = Type::factory()->create([
            'nom' => 'Autre',
        ]);
    }
}
