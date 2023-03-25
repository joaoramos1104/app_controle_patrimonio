<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->string('modelo');
            $table->string('serial_number')->nullable();
            $table->string('cor')->nullable();
            $table->string('tamanho')->nullable();
            $table->string('observacao')->nullable();
            $table->float('valor', 10,2)->nullable();
            $table->float('valor_depr', 10,2)->nullable();
            $table->string('num_ativo');
            $table->string('placa')->nullable();
            $table->string('chassis')->nullable();
            $table->integer('qtd');
            $table->float('tx_depreciacao', 10,2);
            $table->integer('condicao_id')->unsigned();
            $table->foreign('condicao_id')->references('id')->on('condicoes');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->integer('created_at_user_id')->unsigned();
            $table->integer('updated_at_user_id')->unsigned();
            $table->foreign('created_at_user_id')->references('id')->on('users');
            $table->foreign('updated_at_user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
};
