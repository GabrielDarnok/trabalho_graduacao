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
            $table->unsignedBigInteger('id_usuario')->nullable(); // Coluna que será a chave estrangeir
            $table->string('nome_produto');
            $table->integer('quantidade_car');
            $table->float('valor_produto',8 , 2);
            $table->float('valor_total',8 , 2);
            $table->string('imagem_produto_1');
            $table->timestamps();

            // Definindo a chave estrangeira
            $table->foreign('id_usuario')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {            
        Schema::dropIfExists('pedidos');
    }
};
