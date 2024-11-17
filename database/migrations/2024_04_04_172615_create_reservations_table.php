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
            $table->string('commentaire')->nullable();
            $table->string('ville_depart');
            $table->string('ville_destination');
            $table->date('date_depart');
            $table->date('date_retour');
            $table->string('classe')->default('economique');
            $table->integer('modification')->default(0);
            $table->foreignId('charge_de_mission_id')->nullable();
            $table->foreignId('agent_cellule_id')->nullable();
            $table->foreignId('chef_cellule_id')->nullable();
            $table->string('status')->default("nouveau");
            $table->string('montant_reservation')->nullable();
            $table->boolean('visa')->default(false);
            $table->foreignId('agence_id')->nullable();
            $table->foreignId('compagnie_id')->nullable();
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
