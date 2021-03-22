<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDangerousConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dangerous_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('associated_danger');
            $table->string('description');
            $table->unsignedBigInteger('danger_id');
            $table->foreign('danger_id')->references('id')->on('dangers');
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
        Schema::dropIfExists('dangerous_conditions');
    }
}
