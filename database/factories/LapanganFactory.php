<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LapanganFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    // split each character into an individual array
    $characters = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

    // generate random char with random length between 1 to 5
    $randomChars = collect($characters)->random(mt_rand(1, 5))->all();

    // add random chars result with random number between 1 until 100
    // e.g BAD5
    $noLapangan = implode('', $randomChars) . mt_rand(1, 100);

    return [
      'no_lapangan' => $noLapangan,
      'harga_per_jam' => mt_rand(20, 100) . '000',
      'deskripsi' => $this->faker->sentence,
    ];
  }
}
