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
        // Ensure foreign keys are enabled for SQLite
        DB::statement('PRAGMA foreign_keys=ON;');

        // Create the inventory_item table
        Schema::create('inventory_item', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->timestamps();
        });

        // Create the service table with a foreign key reference to inventory_item
        Schema::create('service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_item_id')->constrained('inventory_item')->onDelete('cascade');  // Foreign key reference
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service');
        Schema::dropIfExists('inventory_item');
    }
};

