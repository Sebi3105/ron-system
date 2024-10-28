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
         /*   $table->id('report_id');
            $table->integer('technician_id');
            $table->foreign('technician_id')->references('technician_id')->on('technician');
            $table->integer('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customer');
            $table->integer('sku_id');
            $table->foreign('sku_id')->references('sku_id')->on('inventory_item');
            $table->string('service_type');
            $table->date('date_of_completion');
            $table->enum('payment_type',['installment','']);
            $table->enum('payment_method',['credit_card','cash','gcash']);
            $table->string('status');
            $table->text('remarks');
            $table->decimal('cost');
            $table->timestamps();               */
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
