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
        Schema::create('section_translations', function (Blueprint $table) {
       // mandatory fields
       $table->id(); // Laravel 5.8+ use bigIncrements() instead of increments()
       $table->string('locale')->index();

       // Foreign key to the main model
       $table->unique(['section_id', 'locale']);
       $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');

       $table->longText('description');

       // Actual fields you want to translate
       $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_translations');
    }
};
