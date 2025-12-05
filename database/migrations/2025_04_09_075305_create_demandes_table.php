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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('etudiants')->onDelete('cascade');
            $table->string('etablissement');
            $table->string('telephone');
            $table->string('type_stage');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('competences');
            $table->string('service');
            $table->string('lettre_motivation');
            $table->string('cv');
            $table->string('status')->default('en cours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
