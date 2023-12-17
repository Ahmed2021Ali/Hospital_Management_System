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
        Schema::create('service_translations', function (Blueprint $table) {
            $table->id();// Laravel 5.8+ use bigIncrements() instead of increments()

            // fields currently language inserted
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unique(['service_id', 'locale']);
            $table->foreignId('service_id')->references('id')->on('services')->onDelete('cascade');

            // Actual fields you want to translate
            $table->string('name');
            $table->text('description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_translations');
    }
};
