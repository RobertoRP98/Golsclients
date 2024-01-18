<?php

namespace Database\Factories;

/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * Descripción
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 * 
 * @version 1.0.0
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Service::class;

    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle(),
            'description' => $this->faker->city(),
        ];
    }
}
