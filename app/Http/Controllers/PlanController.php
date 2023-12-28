<?php

namespace App\Http\Controllers;

/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Http\Request;
use App\Http\Requests\StorePlan;
use App\Http\Requests\UpdatePlan;
use Notsoweb\Core\Http\Controllers\VueController;
use App\Models\Plan;
use Inertia\Inertia;
use App\Http\Traits\UseFetch;
use Notsoweb\Core\Http\Traits\Controllers\WithPermission;
use Illuminate\Support\Facades\Log;




/**
 * Descripción
 * 
 * @author Roberto Romero Pérez <robertorpsistemas@gmail.com>
 * 
 * @version 1.0.0
 */
class PlanController extends VueController
{
    use UseFetch,
        WithPermission;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vueRoot('dashboard.service.index');
        $this->withDefaultPermissions('services');
    }

    /**
     * Listar planes y $q responde al buscador
     */
    public function index()
    {
        $q = request()->get('q');
        return Inertia::render('Dashboard/Services/Index', [
            'services' => Plan::where(fn ($query) => $query
                ->where('name', 'LIKE', "%{$q}%")
                ->orWhere('description', 'LIKE', "%{$q}%"))
                ->select([
                    'id',
                    'name',
                    'description',
                ])
                ->paginate(config('app.pagination')),
        ]);
    }

    /**
     * Formulario para crear un plan
     */
    public function create()
    {
        return Inertia::render('Dashboard/Plans/Create');
    }

    /**
     * Almacenar un plan
     * Se creo el StorePlan a traves del request
     * en ese request estan los campos obligatorios 
     */
    public function store(StorePlan $request)
    {
        $data = $request->all();
        Plan::create($data);
        return $this->index();
    }

    /**
     * Actualizar un plan
     * Se creo el UpdatePlan a traves del request
     * en ese request estan los campos obligatorios 
     */
    public function update(UpdatePlan $request, $plan): void
    {
        $data = $request->all();
        $model = Plan::find($plan);
        $model->update($data);
    }

    /**
     * Eliminar un plan
     * la variable $plan almacena el ID del plan
     */
    public function destroy($plan): void
    {
        try {
            $plan = Plan::find($plan);
            $plan->delete();
        } catch (\Throwable $th) {
            Log::channel('plans')
                ->error($th->getMessage());
        }
    }
}
