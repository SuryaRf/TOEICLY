<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('toeic_scores', function (Blueprint $table) {
            $table->id();

            // Sesuaikan dengan user.user_id
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');

            $table->integer('score')->nullable();
            $table->date('certificate_date')->nullable();
            $table->string('certificate_pdf')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('toeic_scores');
    }
};
