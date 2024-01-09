<?php

namespace App\Http\Controllers\Dashboard\Client;

/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Models\Service;
use Notsoweb\Core\Http\Controllers\VueController;

/**
 * Recursos de clientes
 * 
 * Peticiones en segundo plano (axios);
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class ResourceController extends VueController
{
    /**
     * Obtener planes de un servicio
     */
    public function getPlans(Service $service)
    {
        return response()->json([
            'plans' => $service->plans()
                ->orderBy('name', 'asc')
                ->get()
        ]);
    }
}
