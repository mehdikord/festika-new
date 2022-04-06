<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FestivalSponsors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festival_sponsors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('festival_id');
            $table->string('name')->nullable();
            $table->string('link')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->foreign('festival_id')->references('id')->on('festivals')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('festival_sponsors');
    }
}
