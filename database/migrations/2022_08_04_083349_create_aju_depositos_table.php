<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjuDepositosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         # compdec
         Schema::table('aju_deposito', function (Blueprint $table) {
            if (Schema::hasColumn('aju_deposito', 'id_deposito')) {
                $table->renameColumn('id_deposito', 'id');    
            }
            
            if (!Schema::hasColumn('aju_deposito', 'created_at')) {
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
        Schema::table('aju_deposito', function (Blueprint $table) {
            if (Schema::hasColumn('aju_deposito', 'timestamps')) {
                $table->dropColumn('created_at');
            }
        });
    }
}
