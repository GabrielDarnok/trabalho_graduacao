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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_endereco')->nullable(); // Coluna que será a chave estrangeir
            $table->json('id_produto');
            $table->json('tamanho_produto');
            $table->json('cor_produto');
            $table->json('quantidade_produto');
            $table->float('total_pedido',8 , 2);
            $table->boolean('status_pagamento');
            $table->timestamps();

            // Definindo a chave estrangeira
            $table->foreign('id_endereco')
                ->references('id')
                ->on('enderecos')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {    
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropForeign(['id_endereco']);
        });
        
        Schema::dropIfExists('pedidos');
    }
};
