<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_toeic', function (Blueprint $table) {
            $table->id('nilai_toeic_id');
            $table->string('file_path'); // Path to the PDF file
            $table->unsignedBigInteger('itc_id')->nullable(); // Foreign key to ITC user
            $table->foreign('itc_id')->references('itc_id')->on('itc')->onDelete('set null');
            $table->string('judul')->nullable(); // Optional title for the PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_toeic');
    }
};