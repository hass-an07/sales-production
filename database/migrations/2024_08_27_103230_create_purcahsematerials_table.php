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
        Schema::create('purchasematerials', function (Blueprint $table) {
            $table->id();
            $table->string('po_number')->nullable();
            $table->foreign('po_number')->references('po_number')->on('purchase_orders')->onDelete('cascade');
            $table->string('material_type');
            $table->string('material');
            $table->string('quantity');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchasematerials');
    }
};
