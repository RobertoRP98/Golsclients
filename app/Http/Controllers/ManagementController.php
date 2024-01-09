<?php

namespace App\Http\Controllers;

/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Notsoweb\Core\Http\Controllers\VueController;

/**
 * Descripción
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class ManagementController extends VueController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
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
            'Dashboard/Gestion/Index',
            [
                'contracts' => $contracts,
                'client' => $client

            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
