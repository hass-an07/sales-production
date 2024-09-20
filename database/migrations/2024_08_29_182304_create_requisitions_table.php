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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by'); // Foreign key to users table (if applicable)
            $table->date('date');
            $table->time('time');
            $table->unsignedBigInteger('company_id'); // Foreign key to companies table
            $table->string('requisition');
            $table->string('status');
            $table->string('store')->default('main_store');
            $table->unsignedBigInteger('dept_id'); // Foreign key to departments table
            $table->string('receiver');
            $table->unsignedBigInteger('material_ty_id'); // Foreign key to material types table
            $table->string('material'); // Foreign key to materials table
            $table->integer('qty');
            $table->decimal('price', 8, 2);
            $table->decimal('total', 8, 2);
            $table->unsignedBigInteger('issue_for_id'); // Foreign key to departments table for issue for

            // Add foreign key constraints
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('material_ty_id')->references('id')->on('material_types')->onDelete('cascade');
            $table->foreign('issue_for_id')->references('id')->on('departments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};
