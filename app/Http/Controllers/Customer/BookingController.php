<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\{Lapangan, Penyewaan, Notification};
use App\Http\Requests\Penyewaan\StoreRequest;

class BookingController extends Controller
{
  public function create()
  {
    $lapangans = Lapangan::orderByDesc('created_at')->get();

    return view('customer.booking', [
      'lapangans' => $lapangans,
      'notificationCount' => Notification::notificationCount(),
    ]);
  }

  public function store(StoreRequest $request)
  {
    $formFields = $request->validated();

    $formFields['tanggal_sewa'] = "$formFields[tanggal_sewa] $formFields[jam_sewa]:00";

    unset($formFields['jam_sewa']);

    $idLapangan = $formFields['id_lapangan'];


    $lapangan = Lapangan::findOrFail($idLapangan);

    $formFields['harga_per_jam'] = $lapangan->harga_per_jam;

    $formFields['total_harga'] = intval($lapangan->harga_per_jam) * intval($formFields['lama_sewa']);

    $formFields['uang_kembalian'] = intval($formFields['uang_bayar']) - $formFields['total_harga'];

    $formFields['id_user'] = auth()->id();

    try {
      DB::beginTransaction();
      Penyewaan::create($formFields);

      $customerName = auth()->user()->name;
      $noLapangan = $lapangan->no_lapangan;

      $formFields = [
        'id_user' => $formFields['id_user'],
        'data' => "Yth. $customerName, Booking lapangan $noLapangan anda sedang diproses"
      ];

      Notification::create($formFields);

      DB::commit();
    } catch (\Exception) {
      DB::rollBack();

      return back()->with('message', 'Terjadi error, silahkan coba dalam beberapa saat lagi');
    }

    return redirect('/')->with('message', 'Booking berhasil');
  }
}
