<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompdecAnexosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('com_anexo', function (Blueprint $table) {
                        
            if (!Schema::hasColumn('com_anexo', 'created_at')) {
                $table->timestamps();
            }

            if (!Schema::hasColumn('com_anexo', 'id_compdec')) {
                $table->integer('id_compdec')->unsigned();
            }
           
            $table->foreign('id_compdec')->references('id')->on('com_comdec');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('com_anexo');
    }
}
