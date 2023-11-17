<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCedecUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cedec_usuario', function (Blueprint $table) {
            if (Schema::hasColumn('cedec_usuario', 'id_usuario')) {
                $table->renameColumn('id_usuario', 'id');    
            }
            
            if (!Schema::hasColumn('cedec_usuario', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cedec_usuario', function (Blueprint $table) {
            
            if (Schema::hasColumn('cedec_usuario', 'timestamps')) {
                $table->dropColumn('created_at');
            }


        });
    }
}
