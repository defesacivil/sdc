<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompdecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # compdec
        Schema::table('com_comdec', function (Blueprint $table) {
            if (Schema::hasColumn('com_comdec', 'id_comdec')) {
                $table->renameColumn('id_comdec', 'id');
            }

            if (!Schema::hasColumn('com_comdec', 'created_at')) {
                $table->timestamps();
            }

            if (!Schema::hasColumn('com_comdec', 'id_municipio')) {

                Schema::table('com_comdec', function ($table) {
                    $table->foreign('id_municipio')->references('id')->on('cedec_municipio')->onDelete('cascade');
                });
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
            if (Schema::hasColumn('com_comdec', 'timestamps')) {
                $table->dropColumn('created_at');
            }
        });
    }
}
