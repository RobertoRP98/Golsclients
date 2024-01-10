<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Dashboard\Client\ResourceController as ClientResourceController;
use App\Http\Controllers\Dashboard\HistoryLogController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Developer\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Example\IndexController as ExampleIndexController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;

/**
 * Rutas generales/publicas
 * 
 * Rutas accesibles por todos los usuarios y no usuarios
 */
Route::redirect('/', '/login');

/**
 * Rutas del Dashboard
 * 
 * El dashboard es el panel de los usuarios de forma general
 */
Route::prefix('dashboard')->name('dashboard.')->middleware([
    'auth:sanctum',
    'verified',
    config('jetstream.auth_session')
])->group(function () {
    Route::get('/welcome', [IndexController::class, 'index'])->name('index');
    Route::inertia('/changelogs', 'Dashboard/Changelogs')->name('changelogs');
    Route::inertia('/help', 'Dashboard/Help')->name('help');
    Route::resource('clients', ClientController::class);
    Route::resource('management', ManagementController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('services', ServiceController::class);
    /** 
     * Rutas para los planes que se le crean al cliente
     */
    Route::prefix('/clients/{client}')->name('clients.')->group(function () {
        Route::get('/contracts', [ClientController::class, 'contractsIndex'])->name('contracts.index');
        Route::get('/contracts/create', [ClientController::class, 'contractsCreate'])->name('contracts.create');
        Route::Post('/contracts/create', [ClientController::class, 'storeContract'])->name('contracts.store');
    });


    # Log de Acciones
    Route::resource('histories', HistoryLogController::class)->only([
        'index',
        'store'
    ]);

    Route::resource('notifications', NotificationController::class);
    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/notifications', [UserController::class, 'getNotifications'])->name('notifications');
    });
});

/**
 * Rutas de administrador
 * 
 * Estas ubicaciones son del administrador, sin embargo el desarrollador
 * puede acceder a ellas.
 */
Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session')
])->group(function () {
    Route::resource('users', UserController::class);

    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('{user}/settings', [UserController::class, 'settings'])->name('settings');
        Route::post('/password', [UserController::class, 'updatePassword'])->name('password');
        Route::post('/syncRoles', [UserController::class, 'syncRoles'])->name('syncRoles');
    });
});

/**
 * Rutas solo del desarrollador
 * 
 * Son ubicaciones o funciones que pueden llegar a ser muy sensibles en el sistema, por lo que
 * solo el desarrollador debe de ser capaz de modificarlas o actualizarlas.
 */
Route::prefix('developer')->name('developer.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session')
])->group(function () {
    Route::resource('roles', RoleController::class);
});

/**
 * Elementos de la plantilla
 * 
 * Estos son elementos que existen y pueden ser usados en la plantilla, vienen ejemplos de uso.
 * 
 * Estas rutas pueden ser comentadas o eliminadas cuando se finalice un proyecto. Por default estan ocultas
 * en el dashboard.
 */
Route::prefix('examples')->name('examples.')->middleware([
    'auth:sanctum',
    'verified',
    config('jetstream.auth_session')
])->group(function () {
    Route::get('/', [ExampleIndexController::class, 'index'])->name('index');
});

/**
 * Rutas de recursos (axios)
 */
Route::prefix('resources')->name('resources.')->middleware([
    'auth:sanctum',
    'verified',
    config('jetstream.auth_session')
])->group(function () {
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('{service}/get-plans', [ClientResourceController::class, 'getPlans'])->name('get-plans');
    });
});
