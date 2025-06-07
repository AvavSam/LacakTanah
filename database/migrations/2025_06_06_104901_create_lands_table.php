<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('lands', function (Blueprint $table) {
      $table->id();
      $table->string('owner_name');
      $table
        ->string('kode_bidang')
        ->unique()
        ->nullable();
      $table->text('alamat')->nullable();
      $table->string('desa_kelurahan')->nullable();
      $table->string('kecamatan')->nullable();
      $table->string('kabupaten')->nullable();
      $table->string('provinsi')->nullable();
      $table->decimal('latitude', 10, 7)->nullable();
      $table->decimal('longitude', 10, 7)->nullable();
      $table->integer('luas_m2')->nullable();
      $table->enum('status', ['Milik', 'Sewa', 'Belum Sertifikat', 'Dalam Proses'])->default('Belum Sertifikat');
      $table->string('dokumen_path')->nullable();
      $table->date('dokumen_expiry')->nullable();
      $table->string('photo_path')->nullable();
      $table
        ->foreignId('created_by')
        ->constrained('users')
        ->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('lands');
  }
};
