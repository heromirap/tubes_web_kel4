<x-dashboard.layout :title="'Tambah lapangan'">
    <div class="box-form">
        <h1>Tambah Data Lapangan</h1>

        <form action="{{ route('lapangan.store') }}" method="post">
            @csrf
            <div>
                <label for="no_lapangan">No Lapangan</label>
                <input type="text" name="no_lapangan" id="no_lapangan" value="{{ old('no_lapangan') }}">
                @error('no_lapangan')
                  <small class="text-validation-error">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="harga_per_jam">Harga per Jam</label>
                <input type="text" name="harga_per_jam" id="harga_per_jam" value="{{ old('harga_per_jam') }}">
                @error('harga_per_jam')
                  <small class="text-validation-error">{{ $message }}</small>
                @enderror
            </div>
            <div>
              <label for="deskripsi">Deskripsi</label>
              <textarea name="deskripsi" id="deskripsi" cols="30" rows="2">{{ old('deskripsi') }}</textarea>
              @error('deskripsi')
                <small class="text-validation-error">{{ $message }}</small>
              @enderror
            </div>
            <div>
              <label for="status">Status</label>
              <select name="status" id="status">
                <option>-- Pilih Status --</option>
                <option value="tersedia" @checked(old('status') == 'tersedia')>Tersedia</option>
                <option value="tak tersedia" @checked(old('status') == 'tak tersedia')>Tak Tersedia</option>
              </select>
              @error('status')
                <small class="text-validation-error">{{ $message }}</small>
              @enderror
            </div>
            <div>
                <label for=""></label>
                <input type="submit" value="Tambah" class="submit-btn">
            </div>
            <div>
                <label for=""></label>
                <a href="{{ route('lapangan.index') }}" class="btn btn-back">Kembali</a>
            </div>
        </form>
    </div>
</x-dashboard.layout>
