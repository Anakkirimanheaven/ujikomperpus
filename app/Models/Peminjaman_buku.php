<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman_buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','jumlah','tgl_pinjam','jatuh_tempo','id_user','status','id_buku'
    ];

    public $timestamps = true;

    public function buku() {
        return $this->belongsTo(Buku::class,'id_buku');
    }
    public function user() {
        return $this->belongsTo(User::class,'id_user');
    }

    public function pengembalian() {
        return $this->hasMany(Pengembalian::class);
    }
}
