<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiket', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket');
            $table->string('nama_tiket');
            $table->string('image')->nullable();
            $table->foreignId('kota_id');
            $table->foreignId('category_id');
            $table->foreignId('provinsi_id');
            $table->integer('stok');
            $table->integer('harga');
            $table->text('deskripsi_tiket');
            $table->text('excerpt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiket');
    }
};
