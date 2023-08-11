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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Inserisco i campi della tabella
            $table->string('project_name', 64);
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status', 64);
            $table->integer('budget');
            $table->integer('progress');
            $table->string('main_picture')->nullable();




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
        Schema::dropIfExists('projects');
    }
};
