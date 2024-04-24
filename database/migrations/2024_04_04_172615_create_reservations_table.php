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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('numero_dossier')->nullable();
            $table->string('numero_passport')->nullable();
            $table->string('file_passport')->nullable();
            $table->string('ville_depart');
            $table->string('ville_destination');
            $table->string('date_depart');
            $table->string('date_retour');
            $table->integer('modification')->default(0);
            $table->foreignId('charge_de_mission_id')->nullable();
            $table->foreignId('agent_cellule_id')->nullable();
            $table->foreignId('chef_cellule_id')->nullable();
            $table->string('status')->default("nouveau");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
