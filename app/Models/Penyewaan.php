<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;

    protected $table = 'penyewaan';

    protected $with = ['lapangan', 'customer'];

    public function lapangan() {
        return $this->belongsTo(Lapangan::class, 'id_lapangan', 'id');
    }

    public function customer() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
