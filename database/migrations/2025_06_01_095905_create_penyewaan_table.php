<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyewaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_lapangan')->constrained('lapangan')->cascadeOnDelete();
            $table->timestamp('tanggal_sewa');
            $table->unsignedInteger('harga_per_jam');

            // dalam hitungan jam
            $table->unsignedInteger('lama_sewa');
            $table->unsignedInteger('total_harga');
            $table->unsignedInteger('uang_bayar');
            $table->unsignedInteger('uang_kembalian');
            $table->enum('status', ['belum dikonfirmasi', 'pesanan diterima', 'pesanan ditolak']);
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
        Schema::dropIfExists('penyewaan');
    }
}
