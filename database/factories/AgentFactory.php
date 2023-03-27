<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->FirstName(),
            'telephone' => $this->faker->phoneNumber,
            'adresse' => $this->faker->address,
            'date_embauche' => now()
            
        ];
    }
}
