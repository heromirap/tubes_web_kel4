<?php

namespace App\Http\Controllers\Print\Lapangan;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
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
      $lapangans = Lapangan::all();

      return view('dashboard.lapangan.print', [
        'lapangans' => $lapangans
      ]);
    }
}
