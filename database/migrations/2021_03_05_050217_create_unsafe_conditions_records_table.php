<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnsafeConditionsRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unsafe_conditions_records', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('NO INICIADA');
            $table->string('condition_detected');
            $table->unsignedBigInteger('type_condition_id');
            $table->foreign('type_condition_id')->references('id')->on('type_conditions');
            $table->string('detection_origin');
            $table->date('deadline');
            $table->unsignedBigInteger('responsable_id');
            $table->foreign('responsable_id')->references('id')->on('people');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('companies_and_departments');
            $table->string('area');
            $table->integer('probability');
            $table->integer('impact');
            $table->integer('frequency');
            $table->integer('risk');
            $table->string('risk_type');
            $table->string('attention_priority');
            $table->string('scope');
            $table->string('notice_number');
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')->references('id')->on('people');
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
        Schema::dropIfExists('unsafe_conditions_records');
    }
}
