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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->enum('type_ticket',['nouvelle demande','demande de modification','reponse']);
            $table->string('demande_titre');
            $table->string('demande_message')->nullable();
            $table->string('demande_ville_depart');
            $table->string('demande_ville_destination');
            $table->string('demande_date_depart');
            $table->string('demande_date_retour');
            $table->string('reponse_titre')->nullable();
            $table->string('reponse_message')->nullable();
            $table->string('reponse_ville_depart')->nullable();
            $table->string('reponse_ville_destination')->nullable();
            $table->string('reponse_date_depart')->nullable();
            $table->string('reponse_date_retour')->nullable();
            $table->integer('reponse_cout')->nullable();
            $table->foreignId('agence_id')->nullable();
            $table->foreignId('compagnie_id')->nullable();
            $table->foreignId('reservation_id');
            $table->foreignId('agent_cellule_id')->constrained('users');
            $table->foreignId('chef_cellule_id')->constrained('users');
            $table->enum('status',['nouveau','traitement','attente','approuve','refuse'])->default('nouveau');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
