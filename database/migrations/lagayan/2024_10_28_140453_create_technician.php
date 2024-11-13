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
        Schema::create('technician', function (Blueprint $table) {
            $table->id('technician_id');
            $table->string('name');
<<<<<<<< HEAD:database/migrations/lagayan/2024_10_28_140453_create_technician.php
            $table->string('contact_no', 11); 
                            
========
            $table->bigInteger('contact_no');
>>>>>>>> main:database/migrations/2024_10_28_140453_create_technician.php
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technician');
    }
};
