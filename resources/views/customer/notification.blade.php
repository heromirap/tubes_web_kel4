<x-customer.layout :title="'Data Notifikasi'" :notificationCount="$notificationCount">
  <p class="fs-2 text-center mt-5 ">Notifikasi</p>
    <hr class="mt-5">
    <div class="container">
        <div class="d-flex justify-content-end">

            <form action="/notifications" method="get">
                <a href="/notifications" class="link-success">Refresh</a>
                <input type="text" name="keyword" value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-success">Search</button>
            </form>
        </div>

        <table class="mt-2 mb-4 table table-striped ">
            <tr>
                <th>No</th>
                <th>Pesan</th>
                <th>Tanggal</th>
                <th class="text-center">Aksi</th>
            </tr>
            
            @foreach ($notifications as $notification)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $notification->data }}</td>
                    <td>{{ \Carbon\Carbon::parse($notification->created_at)->translatedFormat('l, d F Y H:i') }}</td>
                    <td class="text-center">
                      <form action="{{ route('notifications.destroy', $notification->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                      </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="d-flex justify-content-end">
            {{ $notifications->links() }}
        </div>
    </div>
</x-customer.layout>