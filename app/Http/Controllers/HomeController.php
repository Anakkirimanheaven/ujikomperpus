<?php

namespace App\Http\Controllers;
use App\Charts\BukuChart;
use App\Models\Peminjaman_buku;
use App\Models\Kategori;
use App\Models\Penulis;
use App\Models\Penerbit;
use App\Models\Buku;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(BukuChart $chart)
{
    $kategori = Kategori::count('id');
    $penulis = Penulis::count('id');
    $penerbit = Penerbit::count('id');
    $buku = Buku::count('id');
    $peminjaman = Peminjaman_buku::count('id');
    $pengembalian = Peminjaman_buku::where('status', 'Sudah Dikembalikan')->count('id');

    $user = Auth::user();

    if ($user->role === 'admin') {
        return view('admin.dashboard', compact('user'));
    } elseif ($user->role === 'petugas') {
        return view('admin.dashboard', compact('user'));
    } else {
        return view('user.dashboarduser', [
            'chart' => $chart,
            'buku' => $buku,
            'penerbit' => $penerbit,
            'penulis' => $penulis,
            'kategori' => $kategori,
            'pengembalian' => $pengembalian,
            'peminjaman' => $peminjaman,
        ]);
    }
}
}
