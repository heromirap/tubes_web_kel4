<?php

namespace App\Http\Controllers\Print\Penyewaan;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use Illuminate\Http\Request;

class PrintController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Request $request)
  {
    $penyewaans = Penyewaan::all();

    return view('dashboard.penyewaan.print', [
      'penyewaans' => $penyewaans
    ]);
  }
}
