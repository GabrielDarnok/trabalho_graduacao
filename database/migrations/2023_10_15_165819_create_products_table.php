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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome_produto');
            $table->string('categoria_produto');
            $table->string('imagem_produto');
            $table->string('imagem_produto_2');
            $table->string('imagem_produto_3');
            $table->string('imagem_produto_4');
            $table->integer('quantidade_estoq');
            $table->text('descricao_produto');
            $table->json('cor_produto');
            $table->json('tamanho_roupa');
            $table->float('valor_produto',8 , 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
