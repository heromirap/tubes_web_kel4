<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $with = ['customer'];

    public function customer() {
      return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public static function notificationCount() {
      if ( auth()->check() ) return Notification::where('id_user', auth()->id())->count();
    }

    public function scopeFilter($query, ?string $keyword) {
      $query->when(isset($keyword), function($q) use ($keyword) {
        return $q->where('data', 'like', '%' . $keyword . '%');
      });
    }
}