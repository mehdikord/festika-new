<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Invoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('festival_id')->nullable();
            $table->string('price')->nullable();
            $table->string('title')->nullable();
            $table->string('code')->nullable();
            $table->string('festival_disk')->nullable();
            $table->string('festival_quantity')->nullable();
            $table->string('festival_period')->nullable();
            $table->boolean('paid')->default(1);
            $table->timestamps();
            $table->foreign('creator_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('festival_id')->references('id')->on('festivals')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
