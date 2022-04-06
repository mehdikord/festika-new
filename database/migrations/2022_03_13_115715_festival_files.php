<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FestivalFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festival_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('festival_id');
            $table->unsignedBigInteger('user_id');
            $table->string('file')->nullable();
            $table->string('code')->nullable();
            $table->string('type')->nullable();
            $table->string('size')->nullable();
            $table->timestamps();
            $table->foreign('festival_id')->references('id')->on('festivals')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('festival_files');
    }
}
