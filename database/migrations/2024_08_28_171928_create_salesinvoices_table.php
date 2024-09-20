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
        Schema::create('salesinvoices', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->unsignedBigInteger('dept_id')->nullable();
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('set null');
            $table->string('reciver_name');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_qty');
            $table->string('net_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salesinvoices');
    }
};
