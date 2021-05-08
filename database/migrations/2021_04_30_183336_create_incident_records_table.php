<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_records', function (Blueprint $table) {
            $table->id();
            $table->string('classification')->notNullable();
            $table->boolean('sif')->notNullable()->default(false);
            $table->date('event_date')->notNullable();
            $table->string('description')->notNullable();
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('companies_and_departments');
            $table->string('spesific_area');
            $table->unsignedBigInteger('incident_id');
            $table->foreign('incident_id')->references('id')->on('incidents');
            $table->string('incident_reason')->notNullable();
            $table->string('reason_description');
            $table->string('involbed_people_names')->default('N/A');
            $table->string('solution_description');
            $table->unsignedBigInteger('people_id');
            $table->foreign('people_id')->references('id')->on('people');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('incident_records');
    }
}
