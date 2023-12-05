<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dci_id')->references('id')->on('dcis')->nullable();
            $table->foreignId('source_id')->references('id')->on('sources')->nullable();
            $table->string('title')->nullable();
            $table->string('laboratory')->nullable();
            $table->string('news_link')->nullable();
            $table->text('summary')->nullable();
            $table->string('risk')->nullable();
            $table->foreignId('category_id')->references('id')->on('categories')->nullable();
            $table->date('news_date')->nullable();
            $table->string('country_concerned')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
