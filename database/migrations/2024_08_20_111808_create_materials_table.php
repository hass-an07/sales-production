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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_type_id')->nullable();
            $table->foreign('material_type_id')
                  ->references('id')
                  ->on('material_types')
                  ->onDelete('cascade');
            $table->string('material');
            $table->string('unit');
            $table->timestamps();

            // Adding an index on material_type_id
            $table->index('material_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
