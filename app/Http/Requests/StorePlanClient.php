<?php

namespace App\Http\Requests;

/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Foundation\Http\FormRequest;

/**
 * Descripción
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class StorePlanClient extends FormRequest
{
    /**
     * Determinar si el usuario esta autorizado
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Reglas de validación
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'plan_id' => ['required', 'numeric'],
        ];
    }
}
