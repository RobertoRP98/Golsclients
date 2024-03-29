<?php

namespace Database\Seeders;

/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Notsoweb\Core\Http\Traits\Seeders\RolePermission;

/**
 * Roles y permisos iniciales
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class RoleSeeder extends Seeder
{
    use RolePermission;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::withoutEvents(function () {
            // Permisos para gestionar roles del sistema
            [
                $rolesIndex,
                $rolesCreate,
                $rolesEdit,
                $rolesDestroy
            ] = $this->onCRUD('roles', 'Roles');

            // Permisos para acceder al historial del sistema
            $historiesIndex = $this->onIndex('histories', 'Historial global');

            // Permisos para usuarios
            [
                $usersIndex,
                $usersCreate,
                $usersEdit,
                $usersDestroy
            ] = $this->onCRUD('users', 'Usuarios:');

            $usersConfig = $this->onPermission('users.config', 'Usuarios: Configuraciones adicionales');

            // Permisos para los servicios
            [
                $servicesIndex,
                $servicesCreate,
                $servicesEdit,
                $servicesDestroy
            ] = $this->onCRUD('services', 'Servicios:');


            // Permisos para los planes
            [
                $plansIndex,
                $plansCreate,
                $plansEdit,
                $plansDestroy
            ] = $this->onCRUD('plans', 'Planes:');


            // Permisos para los clientes
            [
                $clientsIndex,
                $clientsCreate,
                $clientsEdit,
                $clientsDestroy
            ] = $this->onCRUD('clients', 'Clientes:');


            // Permisos para los planes asignados a cada cliente
            [
                $contractsIndex,
                $contractsCreate,
                $contractsEdit,
                $contractsDestroy
            ] = $this->onCRUD('contracts', 'Planes del cliente:');


            // Permisos para la gestion de los clientes
            [
                $managementIndex,
                $managementCreate,
                $managementEdit,
                $managementDestroy
            ] = $this->onCRUD('management', 'Gestión de los cliente:');

            //corer  php artisan migrate:refresh --seed al crear mas permisos

            /**
             * Roles con asignación de permisos
             */

            // Desarrollador
            Role::create([
                'name' => 'developer',
                'description' => 'Desarrollador'
            ])->givePermissionTo(Permission::all());

            // Role de administrador
            Role::create([
                'name' => 'admin',
                'description' => 'Administrador'
            ])->givePermissionTo(
                $historiesIndex,
                $usersIndex,
                $usersCreate,
                $usersEdit,
                $usersDestroy,
                $servicesIndex,
                $servicesCreate,
                $servicesEdit,
                $servicesDestroy,
                $plansIndex,
                $plansCreate,
                $plansEdit,
                $plansDestroy,
                $clientsIndex,
                $clientsCreate,
                $clientsEdit,
                $clientsDestroy,
                $contractsIndex,
                $contractsCreate,
                $contractsEdit,
                $contractsDestroy,
                $managementIndex,
                $managementCreate,
                $managementEdit,
                $managementDestroy
            );

            // Role de supervisor (solo lectura)
            Role::create([
                'name' => 'supervisor',
                'description' => 'Supervisor: Solo lectura'
            ])->givePermissionTo(
                $historiesIndex,
                $rolesIndex,
                $usersIndex,
                $servicesIndex,
                $plansIndex,
                $clientsIndex,
                $contractsIndex,
                $managementIndex,


            );
        });
    }
}
