<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanionCareRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companion_care_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('companion_to_care_id');
            $table->foreign('companion_to_care_id')->references('id')->on('people');

            $table->string('turn');
            $table->string('shift_supervisor');
            $table->string('description');
            $table->string('corr_prev_pos');

            $table->unsignedBigInteger('behavior_group_id');
            $table->foreign('behavior_group_id')->references('id')->on('behaviors_groups');
            $table->unsignedBigInteger('acts_types_id')->nullable();
            $table->foreign('acts_types_id')->references('id')->on('acts_types');

            $table->string('sif')->nullable();
            $table->unsignedBigInteger('gold_rules_id')->nullable();
            $table->foreign('gold_rules_id')->references('id')->on('gold_rules');

            $table->string('detection_source');
            $table->unsignedBigInteger('department_where_happens_id');
            $table->foreign('department_where_happens_id')->references('id')->on('companies_and_departments');
            $table->string('specific_area');

            $table->unsignedBigInteger('people_id');
            $table->foreign('people_id')->references('id')->on('people');
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
        Schema::dropIfExists('companion_care_records');
    }
}
