<?php

use App\Models\Lapangan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{RegisterController, LoginController, LogoutController};
use App\Http\Controllers\Print\Lapangan\PrintController as LapanganPrintController;
use App\Http\Controllers\Print\Penyewaan\PrintController as PenyewaanPrintController;
use App\Http\Controllers\Customer\{NotificationController, BookingController, HomeController, LapanganController as CustomerLapanganController, PenyewaanController as CustomerPenyewaanController};
use App\Http\Controllers\Admin\{LapanganController as AdminLapanganController, PenyewaanController as AdminPenyewaanController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::redirect('/', '/dashboard/lapangan');
// get single lapangan
Route::get('/getLapangan/{lapangan}', function (Lapangan $lapangan) {
  return $lapangan;
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lapangan', [CustomerLapanganController::class, 'index']);

// CUSTOMER

Route::middleware(['auth', 'is_role:2'])->group(function () {
  Route::resource('/notifications', NotificationController::class)->only(['index', 'destroy']);

  // booking lapangan
  Route::controller(BookingController::class)->group(function () {
    Route::get('/booking', 'create');
    Route::post('/booking', 'store');
  });

  Route::get('/penyewaan', [CustomerPenyewaanController::class, 'index']);
});

// END OF CUSTOMER


// ADMIN

Route::middleware(['auth', 'is_role:1'])->group(function () {

  Route::get('/dashboard', function () {
    return view('dashboard.home');
  });

  Route::prefix('dashboard')->group(function () {

    Route::get('/lapangan/print', LapanganPrintController::class);
    Route::get('/penyewaan/print', PenyewaanPrintController::class);

    Route::resources([
      'lapangan' => AdminLapanganController::class,
      'penyewaan' => AdminPenyewaanController::class
    ]);
  });

  Route::post('/penyewaan/accept/{penyewaan}', [AdminPenyewaanController::class, 'acceptBooking']);
  Route::post('/penyewaan/reject/{penyewaan}', [AdminPenyewaanController::class, 'rejectBooking']);
});


// user authentication
Route::middleware('guest')->group(function () {
  Route::controller(LoginController::class)->group(function () {

    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'authenticate');
  });

  Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index');
    Route::post('/register', 'create');
  });
});


Route::middleware('auth')->group(function () {
  Route::post('/logout', [LogoutController::class, 'logout']);
});