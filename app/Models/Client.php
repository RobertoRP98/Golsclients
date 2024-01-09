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
 * @version 1.0.0
 */
class Client extends Model
{
    use HasFactory,
        ModelExtend;

    /**
     * Atributos llenables masivamente
     */
    protected $fillable = [
        'name', 'email', 'telephone_company', 'contact_company', 'phone_contact', 'email_contact'
    ];

    /**
     * Relacion muchos a muchos 
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
}
