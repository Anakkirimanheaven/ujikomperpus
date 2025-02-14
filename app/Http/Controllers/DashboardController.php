<?php

namespace App\Http\Controllers;


use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Penulis;
use App\Models\Buku;
use App\Models\Peminjaman_buku;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Charts\BukuChart;

class DashboardController extends Controller
{
    /*
     * @return \Illuminate\Http\Response
     */
    public function index(BukuChart $chart)
    {
        $chartInstance = $chart->build(); // Membuat chart

        $kategori = Kategori::count('id');
        $penulis = Penulis::count('id');
        $penerbit = Penerbit::count('id');
        $buku = Buku::count('id');
        $peminjaman = Peminjaman_buku::count('id');
        $pengembalian = Peminjaman_buku::where('status', 'Sudah Dikembalikan')->count('id');

        return view('admin.dashboard', [
            'buku' => $buku,
            'penerbit' => $penerbit,
            'penulis' => $penulis,
            'kategori' => $kategori,
            'pengembalian' => $pengembalian,
            'peminjaman' => $peminjaman,
            'chart' => $chartInstance,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
