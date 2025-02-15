<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Penulis;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = kategori::all();
        $penerbit = penerbit::all();
        $penulis = penulis::all();
        $buku = Buku::orderBy('stok', 'desc')->paginate(5);
        return view('admin.buku.index', compact('kategori', 'penerbit', 'penulis','buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategori::all();
        $penerbit = penerbit::all();
        $penulis = penulis::all();
        return view('admin.buku.create', compact('kategori','penerbit','penulis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'judul' => 'required|min:1|unique:bukus,judul',
            'deskripsi' => 'required|min:1|',
            'harga' => 'required',
            'stok' => 'required',
            'tahun_terbit' => 'required|date',
            'kode_buku' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048'

        ],
    [
        'judul.required' => 'Book Title Must be Filled!',
        'judul.unique' => 'Book Title with that Name already exists!',
    ]);

        $buku = new buku();
        $buku->judul = $request->judul;
        $buku->deskripsi = $request->deskripsi;
        $buku->harga = $request->harga;
        $buku->stok = $request->stok;
        $buku->kode_buku = $request->kode_buku;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->id_kategori = $request->id_kategori;
        $buku->id_penerbit = $request->id_penerbit;
        $buku->id_penulis = $request->id_penulis;

        // update img
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/buku', $name);
            $buku->image = $name;
        }

        $buku->save();
        Alert::success('Success', 'Data Added Successfully')->autoclose(1500);
        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = buku::findOrFail($id);
        return view('admin.buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = buku::findOrFail($id);
        $kategori = kategori::all();
        $penerbit = penerbit::all();
        $penulis = penulis::all();
        return view('admin.buku.edit', compact('kategori','penerbit','penulis','buku'));
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
        //validate form
        $this->validate($request, [
            'judul' => 'required|min:1|unique:bukus,judul',
            'deskripsi' => 'required|min:1|',
            'harga' => 'required',
            'stok' => 'required|min:2',
            'tahun_terbit' => 'required|date',
            'kode_buku' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ],
    [

    ]);

        $buku = buku::findOrFail($id);
        $buku->judul = $request->judul;
        $buku->deskripsi = $request->deskripsi;
        $buku->harga = $request->harga;
        $buku->stok = $request->stok;
        $buku->kode_buku = $request->kode_buku;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->id_kategori = $request->id_kategori;
        $buku->id_penerbit = $request->id_penerbit;
        $buku->id_penulis = $request->id_penulis;

        // update img
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/buku', $name);
            $buku->image = $name;
        }


           // delete img
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/buku', $name);
            $buku->image = $name;
        }

        $buku->save();
        Alert::success('Success', 'Data has change')->autoclose(1500);
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('buku.index');
    }


    public function detailBuku($id)
{
    $buku = Buku::find($id);

    if (!$buku) {
        return redirect()->route('home')->with('error', 'Buku tidak ditemukan');
    }

    return view('user.detail_buku', compact('buku'));
}



}
