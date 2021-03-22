<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acts_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name')->unique();
            $table->unsignedBigInteger('behavior_group_id');
            $table->foreign('behavior_group_id')->references('id')->on('behaviors_groups');
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
        Schema::dropIfExists('acts_types');
    }
}
