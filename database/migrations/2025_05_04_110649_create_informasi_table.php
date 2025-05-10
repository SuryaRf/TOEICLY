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
        Schema::create('informasi', function (Blueprint $table) {
            $table->id('informasi_id'); // Primary key auto increment
            $table->string('judul', 100); // NOT NULL by default
            $table->text('isi'); // NOT NULL
            $table->unsignedBigInteger('admin_id')->nullable(); // Add the admin_id column
            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('set null'); // Create foreign key relationship
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi');
    }
};
