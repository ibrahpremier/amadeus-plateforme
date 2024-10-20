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
            $table->string('prix')->nullable();
            // $table->string('demande_titre')->nullable();
            // $table->string('demande_message')->nullable();
            // $table->string('demande_ville_depart');
            // $table->string('demande_ville_destination');
            // $table->date('demande_date_depart');
            // $table->date('demande_date_retour');
            $table->string('reponse_titre')->nullable();
            $table->string('reponse_message')->nullable();
            $table->string('reponse_ville_depart')->nullable();
            $table->string('reponse_ville_destination')->nullable();
            $table->date('reponse_date_depart')->nullable();
            $table->date('reponse_date_retour')->nullable();
            $table->string('reponse_file')->nullable();
            $table->string('response_commentaire')->nullable();
            // $table->integer('reponse_cout')->nullable();
            $table->foreignId('agence_id')->nullable();
            $table->foreignId('compagnie_id')->nullable();
            $table->foreignId('reservation_id');
            $table->foreignId('agent_cellule_id')->nullable();
            $table->foreignId('chef_cellule_id')->nullable();
            $table->enum('status', ['nouveau', 'affecté', 'traité', 'non disponible', 'approuvé', 'refusé', 'annulé'])->default('nouveau');
            $table->foreignId('parent_ticket_id')->nullable()->constrained('tickets');
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
