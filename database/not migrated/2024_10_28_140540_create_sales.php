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
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sales_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customer');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('inventory');
            $table->unsignedBigInteger('serial_number')->nullable;
            $table->foreign('serial_number')->references('sku_id')->on('inventory_item');
            $table->enum('state', ['reserved', 'for_pickup', 'for_delivery']);
            $table->date('sale_date');
            $table->decimal('amount', 8, 2);  // Specify precision and scale
            $table->enum('payment_method',['installment', 'full_payment']);
            $table->enum('payment_type', ['credit_card', 'cash', 'gcash', 'paymaya']);
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
