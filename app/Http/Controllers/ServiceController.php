<?php

namespace App\Http\Controllers;

/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Http\Requests\StoreService;
use App\Http\Requests\UpdateService;
use Illuminate\Http\Request;
use Notsoweb\Core\Http\Controllers\VueController;
use App\Models\Service;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\UseFetch;
use Notsoweb\Core\Http\Traits\Controllers\WithPermission;






/**
 * Descripción
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class ServiceController extends VueController
{

    use UseFetch,
        WithPermission;

    public function __construct()
    {
        $this->vueRoot('admin.user');
        $this->withDefaultPermissions('users');
    }

    public function index()
    {
        $services = Service::paginate(config('app.pagination'));
        return Inertia::render('Dashboard/Services/Index', ['services' => $services]);
    }

    public function create()
    {
        return Inertia::render('Dashboard/Services/Create');
    }

    public function store(StoreService $request)
    {
        $data = $request->all();
        Service::create($data);
        return $this->index();
    }

    public function show($id)
    {
        // ...
    }

    public function edit($id)
    {
        // ...
    }

    public function update(UpdateService $request, $service): void
    {
        $data = $request->all();
        $model = Service::find($service);
        $model->update($data);
    }

    public function destroy($service): void
    {
        try {
            $service = Service::find($service);
            $service->delete();
        } catch (\Throwable $th) {
            Log::channel('services')
                ->error($th->getMessage());
        }
    }
}
