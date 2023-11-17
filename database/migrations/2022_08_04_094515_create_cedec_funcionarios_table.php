<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCedecFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cedec_funcionario', function (Blueprint $table) {
            if (Schema::hasColumn('cedec_funcionario', 'id_funcionario')) {
                $table->renameColumn('id_funcionario', 'id');    
            }
            
            if (!Schema::hasColumn('cedec_funcionario', 'created_at')) {
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
        Schema::table('cedec_funcionario', function (Blueprint $table) {
            if (Schema::hasColumn('cedec_funcionario', 'timestamps')) {
                $table->dropColumn('created_at');
            }
        });
        
    }
}
