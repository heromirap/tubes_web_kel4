<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Lapangan\{StoreRequest, UpdateRequest};

class LapanganController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   */
  public function index()
  {
    $lapangans = Lapangan::orderByDesc('created_at')->paginate(10);

    $counter = ($lapangans->perPage() * $lapangans->currentPage()) - $lapangans->perPage() + 1;

    return view('dashboard.lapangan.index', [
      'lapangans' => $lapangans,
      'counter' => $counter
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   */
  public function create()
  {
    return view('dashboard.lapangan.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreRequest $request)
  {
    $formFields = $request->validated();

    Lapangan::create($formFields);

    return redirect(route('lapangan.index'))->with('message', 'Berhasil menambahkan data lapangan');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   */
  public function edit(Lapangan $lapangan)
  {

    return view('dashboard.lapangan.edit', [
      'lapangan' => $lapangan
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateRequest $request, Lapangan $lapangan)
  {
    $formFields = $request->validated();

    $lapangan->update($formFields);

    return redirect(route('lapangan.index'))->with('message', 'Berhasil mengubah data lapangan');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Lapangan $lapangan)
  {
    Lapangan::destroy($lapangan->id);

    return redirect(route('lapangan.index'))->with('message', 'Berhasil menghapus data lapangan');
  }
}
