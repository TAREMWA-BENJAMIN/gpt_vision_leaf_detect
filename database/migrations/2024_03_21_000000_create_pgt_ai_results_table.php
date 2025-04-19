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
        Schema::create('pgt_ai_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->longText('plant_image'); // Using LONGTEXT for base64 data
            $table->string('plant_name');
            $table->enum('status', ['healthy', 'diseased']);
            $table->string('disease_name')->nullable();
            $table->text('disease_details')->nullable();
            $table->text('suggested_solution')->nullable();
            $table->boolean('shared')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pgt_ai_results');
    }
}; 