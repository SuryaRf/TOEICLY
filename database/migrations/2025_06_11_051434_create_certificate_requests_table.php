<?php

  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  return new class extends Migration
  {
      public function up()
      {
          Schema::create('certificate_requests', function (Blueprint $table) {
              $table->id();
              $table->unsignedBigInteger('pendaftaran_id');
              $table->string('status')->default('pending'); // pending, approved, rejected
              $table->text('notes')->nullable();
              $table->string('file_path')->nullable(); // Path ke file PDF yang dihasilkan
              $table->timestamps();

              $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('pendaftaran')->onDelete('cascade');
          });
      }

      public function down()
      {
          Schema::dropIfExists('certificate_requests');
      }
  };