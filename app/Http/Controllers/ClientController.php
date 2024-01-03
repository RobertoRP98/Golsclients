<?php

namespace App\Http\Controllers;

/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Traits\UseFetch;
use App\Models\Client;
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

    /**Formulario para crear un cliente */
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
}
