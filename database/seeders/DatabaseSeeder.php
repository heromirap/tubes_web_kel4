<?php

namespace Database\Seeders;

use App\Models\{User, Lapangan, Penyewaan};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    User::factory(3)->create();

    User::factory(1)->create([
      'username' => 'hecker',
      'name' => 'hecker',
      'email' => 'hecker@gmail.com',
      'role' => 2
    ]);

    User::factory(1)->create([
      'username' => 'admin',
      'name' => 'icall',
      'email' => 'admin@gmai.com',
      'role' => 1
    ]);

    Lapangan::factory(20)->create();
    Penyewaan::factory(20)->create();
  }
}
