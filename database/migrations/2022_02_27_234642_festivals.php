<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Festivals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festivals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->unsignedBigInteger('festival_category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('subtitle')->nullable();
            $table->longText('description')->nullable();
            $table->longText('terms')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('code')->nullable();
            $table->longText('formats')->nullable();
            $table->longText('mimes')->nullable();
            $table->string('sends')->nullable();
            $table->string('disk')->nullable();
            $table->string('quantity')->nullable();
            $table->string('period')->nullable();
            $table->string('start_at')->nullable();
            $table->string('expire_at')->nullable();
            $table->string('files_count')->nullable()->default(0);
            $table->string('disk_usage')->nullable()->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('accepted')->default(0);
            $table->boolean('force_close')->default(0);
            $table->boolean('commenting')->default(1);
            $table->boolean('is_special')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('creator_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('festival_category_id')->references('id')->on('festival_categories')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('festivals');
    }
}
