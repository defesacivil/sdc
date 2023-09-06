<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompdecEquipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        # equipe compdec
        Schema::table('com_eq_comdec', function (Blueprint $table) {
            if (Schema::hasColumn('com_eq_comdec', 'id_equipe')) {
                $table->renameColumn('id_equipe', 'id');    
            }
            
            if (!Schema::hasColumn('com_eq_comdec', 'created_at')) {
                $table->timestamps();
            }

            if(!Schema::hasColumn('com_eq_comdec', 'id_compdec')){
                $table->integer('id_compdec');
            }    
   
        });


        /*Schema::table('com_eq_comdec', function (Blueprint $table) {
            if(Schema::hasColumn('com_eq_comdec', 'id_compdec')){
                $table->foreign('id_compdec')->references('id')->on('com_comdec')->onDelete('cascade');
            }

        });*/


            
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('com_eq_comdec', function (Blueprint $table) {
            if (Schema::hasColumn('com_eq_comdec', 'timestamps')) {
                $table->dropColumn('created_at');
                
            }
            $table->dropForeign('id_compdec');
        });
    }
}
