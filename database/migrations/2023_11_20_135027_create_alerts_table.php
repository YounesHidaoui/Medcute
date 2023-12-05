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
            $table->foreignId('dci_id')->references('id')->on('dcis');
            $table->foreignId('source_id')->references('id')->on('sources');
            $table->string('title');
            $table->string('laboratory ');
            $table->string('news_link');
            $table->text('summary');
            $table->string('risk');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->date('news_date');
            $table->string('country_concerned');
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
