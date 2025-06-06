<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index() {
    $notificationCount = Notification::notificationCount();

    return view('customer.home', [
      'notificationCount' => $notificationCount
    ]);
  }
}