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
use App\Models\Service;
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
        $this->vueRoot('dashboard.plan.index');
        $this->withDefaultPermissions('plans');
    }

    /**
     * Listar planes y $q responde al buscador
     */
    public function index()
    {
        $q = request()->get('q');

        $plans = Plan::with(['service:id,name'])
            ->where(function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%")
                    ->orWhere('price', 'LIKE', "%{$q}%")
                    ->orWhereHas('service', function ($subquery) use ($q) {
                        $subquery->where('name', 'LIKE', "%{$q}%");
                    });
            })
            ->select([
                'id',
                'name',
                'price',
                'service_id'
            ])
            ->paginate(config('app.pagination'));

        /** Se envia la vista del index añadiendo los planes  */
        return Inertia::render(
            'Dashboard/Plans/Index',
            ['plans' => $plans]
        );
    }

    /**
     * Formulario para crear un plan
     */
    public function create()
    {
        return Inertia::render('Dashboard/Plans/Create', ['services' => Service::get()]);
    }

    /**
     * Almacenar un plan
     * Se creo el StorePlan a traves del request
     * en ese request estan los campos obligatorios 
     */
    public function store(StorePlan $request)
    {
        $data = $request->all();
        // $data['service_id'] = $data['service_id']['id'];
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
