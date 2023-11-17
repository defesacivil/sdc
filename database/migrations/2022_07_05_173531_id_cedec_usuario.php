<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IdCedecUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function(Blueprint $table) {
            if (!Schema::hasColumn('users', 'id_user_cedec')) {
                $table->integer('id_user_cedec')->comment('Identificador Cedec_usuario')->default(null)->nullable();
            }
        });

        Schema::table('users', function($table) {
            $table->foreign('id_user_cedec')
                ->references('id_usuario')
                ->on('cedec_usuario');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'id_user_cedec') ) {
            Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id_user_cedec');
            
            });
        }
    }
}
