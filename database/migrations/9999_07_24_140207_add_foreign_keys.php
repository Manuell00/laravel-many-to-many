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
        Schema::table('projects', function (Blueprint $table) {

            // Creo la colonna type_id
            $table->unsignedBigInteger('type_id');

            // Assegno la chiave esterna
            $table->foreign('type_id')

                // Colonna di riferimento dell'altra tabella
                ->references('id')

                // Nome tabella
                ->on('types');
        });

        Schema::table('users', function (Blueprint $table) {

            // Creo la colonna type_id
            $table->unsignedBigInteger('project_id');

            // Assegno la chiave esterna
            $table->foreign('project_id')

                // Colonna di riferimento dell'altra tabella
                ->references('id')

                // Nome tabella
                ->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            // Inserisco il nome della relazione (si vede su sql)
            $table->dropForeign('users_project_id_foreign');

            // Elimino la colonna type_id
            $table->dropColumn('project_id');
        });

        Schema::table('projects', function (Blueprint $table) {

            // Inserisco il nome della relazione (si vede su sql)
            $table->dropForeign('projects_type_id_foreign');

            // Elimino la colonna type_id
            $table->dropColumn('type_id');
        });
    }
};
