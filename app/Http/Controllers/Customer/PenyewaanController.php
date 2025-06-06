<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Models\{Penyewaan as PenyewaanModel, Notification};
use App\Http\Controllers\Controller;

class PenyewaanController extends Controller
{
  public function index()
  {
    $penyewaans = PenyewaanModel::where('id_user', auth()->id())->orderByDesc("created_at")->paginate(10);

    $counter = ($penyewaans->perPage() * $penyewaans->currentPage()) - $penyewaans->perPage() + 1;

    return view('customer.penyewaan', [
      'penyewaans' => $penyewaans,
      'counter' => $counter,
      'notificationCount' => Notification::notificationCount(),
    ]);
  }
}
