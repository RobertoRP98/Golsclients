<?php

namespace App\Http\Controllers;

/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\StoreContract;
use App\Http\Requests\StorePlanClient;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Http\Traits\UseFetch;
use App\Models\Client;
use App\Models\Plan;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Notsoweb\Core\Http\Controllers\VueController;
use Notsoweb\Core\Http\Traits\Controllers\WithPermission;

/**
 * Descripción
 * 
 * @author Roberto Romero Pérez <robertorpsistemas@gmail.com>
 * 
 * @version 1.0.0
 */
class ClientController extends VueController
{

    use UseFetch,
        WithPermission;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vueRoot('admin.user');
        $this->withDefaultPermissions('users');
    }

    /**
     * Listar clientes, q responde a al buscador
     */
    public function index()
    {
        $q = request()->get('q');
        return Inertia::render('Dashboard/Clients/Index', [
            'clients' => Client::where(fn ($query) => $query
                ->where('name', 'LIKE', "%{$q}%")
                ->orWhere('email', 'LIKE', "%{$q}%"))
                ->paginate(config('app.pagination')),
        ]);
    }

    /**
     * Formulario para crear un cliente 
     */
    public function create()
    {
        return Inertia::render('Dashboard/Clients/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $data = $request->all();
        Client::create($data);
        return $this->index();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, $client): void
    {
        $data = $request->all();
        $model = Client::find($client);
        $model->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        try {
            $client = Client::find($client);
            $client->delete();
        } catch (\Throwable $th) {
            Log::channel('clients')
                ->error($th->getMessage());
        }
    }

    /** 
     * Index de los contratos
     */
    public function contractsIndex(Client $client)
    {
        $q = request()->get('q');

        //obtener los planes asociados al cliente

        $contracts = $client->plans()
            ->with(['service:id,name'])
            ->where(function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%")
                    ->orWhere('price', 'LIKE', "%{$q}%")
                    ->orWhereHas('service', function ($subquery) use ($q) {
                        $subquery->where('name', 'LIKE', "%{$q}%");
                    });
            })

            ->paginate(config('app.pagination'));

        /** 
         *Se envia la vista del index añadiendo los planes y servicios 
         */
        return Inertia::render(
            'Dashboard/Clients/Contracts/Index',
            [
                'contracts' => $contracts,
                'client' => $client

            ]
        );
    }
    /**
     * Formulario para crear un plan a un cliente 
     */
    public function contractsCreate(Client $client)
    {
        return Inertia::render('Dashboard/Clients/Contracts/Create', [
            'client' => $client,
            'services' => Service::get(),
        ]);
    }

    /**
     *  Definimos los campos que rellenaremos en StoreContract
     */
    public function storeContract(StorePlanClient $request, Client $client)
    {
        $data = $request->all();
        //dd($data);

        $client->plans()->attach($data['plan_id']);
        return $this->index();
    }
}
