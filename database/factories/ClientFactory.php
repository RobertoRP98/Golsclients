<?php

namespace Database\Factories;

/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * Descripción
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 * 
 * @version 1.0.0
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Client::class;


    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'telephone_company' => $this->faker->phoneNumber(),
            'contact_company' => $this->faker->name(),
            'phone_contact' => $this->faker->phoneNumber(),
            'email_contact' => $this->faker->email(),

        ];
    }
}
