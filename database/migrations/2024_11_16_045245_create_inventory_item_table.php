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
        // Create the inventory_item table
        Schema::create('inventory_item', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Column for the item name
            $table->integer('quantity');  // Column for the quantity of the item
            $table->timestamps();  // Automatically adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the inventory_item table if it exists
        Schema::dropIfExists('inventory_item');
    }
};
