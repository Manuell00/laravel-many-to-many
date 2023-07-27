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

        Schema::table('projects', function (Blueprint $table) {

            // Creo la colonna type_id
            $table->unsignedBigInteger('user_id');

            // Assegno la chiave esterna
            $table->foreign('user_id')

                // Colonna di riferimento dell'altra tabella
                ->references('id')

                // Nome tabella
                ->on('users');
        });

        // Stessa cosa dei precedenti ma più rapido con constrained
        Schema::table('project_technology', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained();
            $table->foreignId('technology_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {

            // Inserisco il nome della relazione (si vede su sql)
            $table->dropForeign('projects_user_id_foreign');

            // Elimino la colonna user_id
            $table->dropColumn('user_id');
        });

        Schema::table('projects', function (Blueprint $table) {

            // Inserisco il nome della relazione (si vede su sql)
            $table->dropForeign('projects_type_id_foreign');

            // Elimino la colonna type_id
            $table->dropColumn('type_id');
        });

        Schema::table('project_technology', function (Blueprint $table) {
            $table->dropForeign('project_technology_project_id_foreign');
            $table->dropForeign('project_technology_technology_id_foreign');


            $table->dropColumn('project_id');

            $table->dropColumn('technology_id');
        });
    }
};
