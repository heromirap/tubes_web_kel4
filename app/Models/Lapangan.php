<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
  use HasFactory;

  protected $table = 'lapangan';

  public function scopeFilter($query, ?string $keyword)
  {
    $query->when(isset($keyword), function($q) use ($keyword) {
        return $q->where('no_lapangan', 'like', '%' . $keyword . '%');
    });

    // if ( ?? false) {
    // }
  }
}
