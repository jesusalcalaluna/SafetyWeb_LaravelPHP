<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('action_name');
            $table->unsignedBigInteger('condition_group_id');
            $table->foreign('condition_group_id')->references('id')->on('condition_groups');
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
        Schema::dropIfExists('type_conditions');
    }
}
