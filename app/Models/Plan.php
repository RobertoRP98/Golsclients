<?php

namespace App\Models;

/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Http\Traits\ModelExtend;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Descripción
 * 
 * @author Roberto Romero Pérez <robertorpsistemas@gmail.com>
 * 
 * 
 * @version 1.0.0
 */
class Plan extends Model
{
    use HasFactory,
        ModelExtend;

    /**
     * Atributos llenables masivamente
     */
    protected $fillable = ['name', 'price', 'service_id'];

    /**
     * Relacion inversa para obtener el dia de servicio
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /** Relacion muchos a muchos*/
    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }
}
