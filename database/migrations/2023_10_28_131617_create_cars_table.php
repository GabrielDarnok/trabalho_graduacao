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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario'); // Coluna que será a chave estrangeira
            $table->unsignedBigInteger('id_produto');
            $table->integer('quantidade_car');
            $table->timestamps();

            // Definindo as chaves estrangeiras
            $table->foreign('id_usuario')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                
            $table->foreign('id_produto')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['id_usuario', 'id_produto']);
        });
        
        Schema::dropIfExists('carrinho');
    }
};
