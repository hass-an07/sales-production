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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('created_by');
            $table->unsignedBigInteger('dept_id')->nullable();  // Make it nullable
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('set null');
            $table->string('worker_code');
            $table->string('name');
            $table->string('reference')->nullable();
            $table->string('age')->nullable();
            $table->string('cnic')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
