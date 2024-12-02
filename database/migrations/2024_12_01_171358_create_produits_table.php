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
    Schema::create('produits', function (Blueprint $table) {
        $table->id();
        $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
        $table->string('nom');
        $table->text('description');
        $table->decimal('prix_vente', 10, 2);
        $table->decimal('prix_achat', 10, 2);
        $table->integer('quantite');
        $table->string('reference')->unique();
        $table->string('image')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
