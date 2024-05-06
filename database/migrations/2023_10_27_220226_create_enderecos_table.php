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
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario'); // Coluna que será a chave estrangeir
            $table->string('cep');
            $table->string('rua');
            $table->string('number_house');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('complemento')->nullable();
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
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
        });

        Schema::dropIfExists('enderecos');
    }
};
