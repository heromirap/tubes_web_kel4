<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request) {
      $notifications = Notification::where('id_user', auth()->id())->filter($request->keyword)->orderByDesc('created_at')->paginate(5);

      $counter = ($notifications->perPage() * $notifications->currentPage()) - $notifications->perPage() + 1;

      return view('customer.notification', [
        'counter' => $counter,
        'notifications' => $notifications,
        'notificationCount' => Notification::notificationCount()
      ]);
    }

    public function destroy(Notification $notification) {
      if ( Notification::destroy($notification->id) ) {
        session()->flash('message', 'Notifikasi berhasil dihapus');
      } else {
        session()->flash('message', 'Notifikasi gagal dihapus');
      }

      return redirect(route('notifications.index'));
    }
}
