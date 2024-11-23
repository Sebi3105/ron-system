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
        Schema::create('technician_report', function (Blueprint $table) {
            $table->id('report_id');

            // Ensure the foreign keys match the type of the primary keys in the referenced tables
            $table->unsignedBigInteger('technician_id');
            $table->foreign('technician_id')->references('technician_id')->on('technician')->onDelete('cascade');

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customer')->onDelete('cascade');

            // $table->unsignedBigInteger('sku_id');
            // $table->foreign('sku_id')->references('sku_id')->on('inventory_item')->onDelete('cascade');
            $table->unsignedBigInteger('sku_id')->nullable(); // Make the column nullable
            $table->foreign('sku_id')->references('sku_id')->on('inventory_item')->onDelete('cascade');


            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('service_id')->on('service')->onDelete('cascade');

            $table->date('date_of_completion');
            $table->enum('payment_type',['installment','full_payment']);
            $table->enum('payment_method',['credit_card','cash','gcash','paymaya']);
            $table->enum('status',['in progress', 'done', 'backjob']);
            $table->text('remarks');
            $table->decimal('cost', 8, 2);       
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technician_report');
    }
};