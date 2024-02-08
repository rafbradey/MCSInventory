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
        Schema::create('UserRequests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); //references id from users table
            $table->foreignId('inventory_id')->nullable()->constrained('inventory')->onDelete('cascade'); //references id from inventory table
            $table->string('status')->default('pending');
            $table->timestamps(); // Group timestamps together
            $table->string('school_property')->required();
            $table->string('property_number')->nullable();
            $table->string('unit_of_measure')->nullable();
            $table->decimal('unit_value', 10, 2)->nullable();
            $table->integer('quantity_per_property')->nullable();
            $table->integer('quantity_per_physical')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('value', 12, 2)->nullable();
            $table->decimal('total_value', 10, 2)->nullable();
            $table->string('remarks')->nullable();
            $table->string('category')->nullable();
            $table->string('acquisition_type')->nullable();
            $table->string('grade_level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
