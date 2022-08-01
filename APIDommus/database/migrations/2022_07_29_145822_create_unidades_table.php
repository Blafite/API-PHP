<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('bloco');
            $table->decimal('valor', 19, 2);
            $table->string('status');
            $table->unsignedBigInteger('id_empreendimento');
            $table->timestamps();
        });

        Schema::table('unidades', function (Blueprint $table)
        {
            $table->foreign('id_empreendimento')->references('id')->on('empreendimentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidades');
    }
}
