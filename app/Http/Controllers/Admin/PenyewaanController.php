<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Lapangan, Notification, Penyewaan, User};
use App\Http\Requests\Penyewaan\{StoreRequest, UpdateRequest};
use Carbon\Carbon;

class PenyewaanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   */
  public function index()
  {
    $penyewaans = Penyewaan::orderByDesc('created_at')->paginate(10);

    $counter = ($penyewaans->perPage() * $penyewaans->currentPage()) - $penyewaans->perPage() + 1;

    return view('dashboard.penyewaan.index', [
      'penyewaans' => $penyewaans,
      'counter' => $counter++
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   */
  public function create()
  {
    $lapangans = Lapangan::orderByDesc('created_at')->get(['id', 'no_lapangan', 'status']);

    return view('dashboard.penyewaan.create', [
      'lapangans' => $lapangans
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
     
   */
  public function store(StoreRequest $request)
  {
    $formFields = $request->validated();

    $formFields['tanggal_sewa'] = "$formFields[tanggal_sewa] $formFields[jam_sewa]:00";

    unset($formFields['jam_sewa']);

    $idLapangan = $formFields['id_lapangan'];

    $lapangan = Lapangan::findOrFail($idLapangan);

    $formFields['harga_per_jam'] = $lapangan['harga_per_jam'];

    $formFields['total_harga'] = intval($lapangan['harga_per_jam']) * intval($formFields['lama_sewa']);

    $formFields['uang_kembalian'] = intval($formFields['uang_bayar']) - $formFields['total_harga'];

    Penyewaan::create($formFields);

    return redirect(route('penyewaan.index'))->with('message', 'Berhasil menambahkan data penyewaan');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
     
   */
  public function edit(Penyewaan $penyewaan)
  {
    $lapangans = Lapangan::orderBydesc('created_at')->get();

    return view('dashboard.penyewaan.edit', [
      'penyewaan' => $penyewaan,
      'lapangans' => $lapangans
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
     
   */
  public function update(UpdateRequest $request, Penyewaan $penyewaan)
  {
    $formFields = $request->validated();

    $formFields['tanggal_sewa'] = "$formFields[tanggal_sewa] $formFields[jam_sewa]:00";

    unset($formFields['jam_sewa']);

    $idLapangan = $formFields['id_lapangan'];

    $lapangan = Lapangan::findOrFail($idLapangan);

    $formFields['harga_per_jam'] = $lapangan['harga_per_jam'];

    $formFields['total_harga'] = intval($lapangan['harga_per_jam']) * intval($formFields['lama_sewa']);

    $formFields['uang_kembalian'] = intval($formFields['uang_bayar']) - $formFields['total_harga'];

    $penyewaan->update($formFields);

    return redirect(route('penyewaan.index'))->with('message', 'Berhasil mengubah data penyewaan');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   */
  public function destroy(Penyewaan $penyewaan)
  {
    if (Penyewaan::destroy($penyewaan->id)) {
      session()->flash('message', 'Berhasil menghapus data penyewaan');
    } else {
      session()->flash('message', 'Gagal menghapus data penyewaan');
    }

    return redirect(route('penyewaan.index'));
  }

  public function acceptBooking(Penyewaan $penyewaan) {
    $penyewaan->update([
      'status' => 'pesanan diterima'
    ]);

    $customer = User::findOrFail($penyewaan->id_user);
    $lapangan = Lapangan::findOrFail($penyewaan->id_lapangan);

    $name = $customer->name;
    $noLapangan = $lapangan->no_lapangan;

    $tanggalBooking = Carbon::parse($penyewaan->created_at)->translatedFormat('l, d F Y H:m');
    $tanggalMain = Carbon::parse($penyewaan->tanggal_sewa)->translatedFormat('l, d F Y H:m');

    Notification::create([
      'id_user' => $customer->id,
      'data' => "Yth. $name, Booking lapangan $noLapangan yang anda lakukan pada $tanggalBooking diterima, silahkan datang pada waktu yang telah anda jadwalkan yaitu $tanggalMain"
    ]);

    return redirect(route('penyewaan.index'))->with('message', 'Booking berhasil diterima');
  }

  public function rejectBooking(Penyewaan $penyewaan) {
    $penyewaan->update([
      'status' => 'pesanan ditolak'
    ]);

    $customer = User::findOrFail($penyewaan->id_user);
    $lapangan = Lapangan::findOrFail($penyewaan->id_lapangan);

    $name = $customer->name;
    $noLapangan = $lapangan->no_lapangan;
    $tanggalBooking = Carbon::parse($penyewaan->created_at)->translatedFormat('l, d F Y H:m');

    Notification::create([
      'id_user' => $customer->id,
      'data' => "Yth. $name, Booking lapangan $noLapangan yang anda lakukan pada $tanggalBooking ditolak"
    ]);

    return redirect(route('penyewaan.index'))->with('message', 'Booking berhasil ditolak');
  }
}