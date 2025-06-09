<?php

namespace Database\Factories;

use App\Models\Lapangan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenyewaanFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $lapangan = Lapangan::find(mt_rand(1, Lapangan::count()));

    $hargaPerJam = $lapangan->harga_per_jam;
    $lamaSewa = mt_rand(1, 5);

    $totalHarga = ($hargaPerJam * $lamaSewa) / 1_000;

    $uangBayar = $totalHarga + mt_rand($totalHarga, $totalHarga * 2);
    $uangKembalian = $uangBayar - $totalHarga;

    $idUser = mt_rand(1, 4);

    // agar lurus e.g 300000 bukan 300232
    $totalHarga = $totalHarga . '000';
    $uangBayar = $uangBayar . '000';
    $uangKembalian = $uangKembalian . '000';

    $status = collect(['pesanan diterima', 'pesanan ditolak'])->random();

    return [
      'id_user' => $idUser,
      'id_lapangan' => $lapangan->id,
      'tanggal_sewa' => $this->faker->dateTimeBetween('-3 years'),
      'harga_per_jam' => $hargaPerJam,
      // hitungan jam
      'lama_sewa' => $lamaSewa,
      'total_harga' => $totalHarga,
      'uang_bayar' => $uangBayar,
      'status' => $status,
      'uang_kembalian' => $uangKembalian,
    ];
  }
}
