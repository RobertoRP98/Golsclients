<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_plan', function (Blueprint $table) {
            /** Nombre de las variables que almacenaran los ids de ambas tablas */
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('plan_id');
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('status');
            /**Creando las referencias */
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_plan');
    }
};
