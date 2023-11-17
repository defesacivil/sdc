<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cedec_municipio', function (Blueprint $table) {
            if (Schema::hasColumn('cedec_municipio', 'id_municipio')) {
                $table->renameColumn('id_municipio', 'id');    
            }
            
            if (!Schema::hasColumn('cedec_municipio', 'created_at')) {
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
        Schema::dropIfExists('municipios');
    }
}
