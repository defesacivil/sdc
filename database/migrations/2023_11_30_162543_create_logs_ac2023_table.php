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
        Schema::create('logs_ac2023', function (Blueprint $table) {
            $table->id();
            $table->enum('level', ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug']);
            $table->integer('iteration')->nullable();
            $table->text('message')->nullable();
            $table->text('user_id')->nullable();
            $table->integer('job_id')->nullable();
            $table->integer('ano', 0);
            $table->integer('jan', 0);
            $table->integer('fev', 0);
            $table->integer('mar', 0);
            $table->integer('abr', 0);
            $table->integer('mai', 0);
            $table->integer('jun', 0);
            $table->integer('jul', 0);
            $table->integer('ago', 0);
            $table->integer('set', 0);
            $table->integer('out', 0);
            $table->integer('nov', 0);
            $table->integer('dez', 0);
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
        Schema::dropIfExists('logs_ac2023');
    }
};
