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
        Schema::create('outwards', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('outward');
            $table->string('g_pass_no');
            $table->string('date');
            $table->string('time');
            $table->string('vehicle');
            $table->unsignedBigInteger('worker_id')->nullable();
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->string('through');
            $table->unsignedBigInteger('dept_id')->nullable();
            $table->foreign('dept_id')->references('id')->on('departments');
            $table->unsignedBigInteger('materialType_id')->nullable();
            $table->foreign('materialType_id')->references('id')->on('material_types');
            $table->unsignedBigInteger('material_id')->nullable();
            $table->foreign('material_id')->references('id')->on('materials');
            $table->unsignedBigInteger('weightType_id')->nullable();
            $table->foreign('weightType_id')->references('id')->on('weight_types');
            $table->string('qty');
            $table->string('username');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outwards');
    }
};
