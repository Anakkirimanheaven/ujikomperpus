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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('deskripsi');
            $table->date('tahun_terbit');
            $table->string('kode_buku');
            $table->integer('stok');
            $table->integer('harga');
            $table->string('image');
            $table->bigInteger('id_penerbit')->unsigned();
            $table->foreign('id_penerbit')->references('id')->on('penerbits')->onDelete('cascade');
            $table->bigInteger('id_penulis')->unsigned();
            $table->foreign('id_penulis')->references('id')->on('penulis')->onDelete('cascade');
            $table->bigInteger('id_kategori')->unsigned();
            $table->foreign('id_kategori')->references('id')->on('kategoris')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
