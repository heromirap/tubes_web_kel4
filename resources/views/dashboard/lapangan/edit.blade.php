<x-dashboard.layout :title="'Edit Lapangan'">
<div class="box-form">
  <h1>Edit Data lapangan</h1>

  <form action="{{ route('lapangan.update', $lapangan->id) }}" method="post">
    @csrf
    @method('put')
    <div>
      <label for="no_lapangan">No Lapangan</label>
      <input type="text" name="no_lapangan" id="no_lapangan" value="{{ $lapangan->no_lapangan }}">
      @error('no_lapangan')
        <small class="text-validation-error">{{ $message }}</small>
      @enderror
    </div>
    <div>
      <label for="harga_per_jam">Harga per Jam</label>
      <input type="text" name="harga_per_jam" id="harga_per_jam" value="{{ $lapangan->harga_per_jam }}">
      @error('harga_per_jam')
        <small class="text-validation-error">{{ $message }}</small>
      @enderror
    </div>
    <div>
      <label for="deskripsi">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" cols="30" rows="2">{{ $lapangan->deskripsi }}</textarea>
      @error('deskripsi')
        <small class="text-validation-error">{{ $message }}</small>
      @enderror
    </div>
    <div>
      <label for="status">Status</label>
      <select name="status" id="status">
        <option>-- Pilih Status --</option>
        <option value="tersedia" @if($lapangan->status == 'tersedia') {{ 'selected' }} @endif>Tersedia</option>
        <option value="tak tersedia" @if($lapangan->status == 'tak tersedia') {{ 'selected' }} @endif>Tak Tersedia</option>
      </select>
      @error('status')
        <small class="text-validation-error">{{ $message }}</small>
      @enderror
    </div>
    <div>
      <label for=""></label>
      <input type="submit" value="Ubah" class="submit-btn">
    </div>
    <div>
      <label for=""></label>
      <a href="{{ route('lapangan.index') }}" class="btn btn-back">Kembali</a>
    </div>
  </form>
</div>
</x-dashboard.layout>