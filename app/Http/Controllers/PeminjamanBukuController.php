<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman_buku;
use App\Models\Buku;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Penulis;
use App\Models\Penerbit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class PeminjamanBukuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pengembalian(Request $request, $id)
    {
        // Validasi input jumlah buku yang dikembalikan
        $this->validate($request, [
            // 'jumlah' => 'required|integer|min:1',
        ]);

        // Ambil data peminjaman berdasarkan ID
        $peminjaman = Peminjaman_buku::findOrFail($id);

        // Cek apakah status peminjaman masih "diterima" (belum dikembalikan)
        if ($peminjaman->status !== 'diterima') {
            Alert::error('Error', 'book not received or returned')->autoclose(1500);
            return redirect()->back();
        }

        // Ambil data buku yang dipinjam
        $buku = Buku::findOrFail($peminjaman->id_buku);

        // Validasi jumlah buku yang dikembalikan tidak lebih dari jumlah yang dipinjam
        if ($request->jumlah > $peminjaman->jumlah) {
            Alert::error('error', 'the books returned exceed the amount borrowed')->autoclose(1500);
            return redirect()->back();
        }

        // Tambahkan kembali stok buku yang dikembalikan
        $buku->jumlah_buku += $request->jumlah;
        $buku->save();

        // Update status peminjaman menjadi "Dikembalikan"
        $peminjaman->status = 'dikembalikan';
        $peminjaman->save();

        Alert::success('Berhasil', 'Buku berhasil dikembalikan.')->autoclose(1500);
        return redirect()->route('peminjaman.index');
    }


    public function history()
    {
        $peminjaman = Peminjaman_buku::latest()->paginate(10); // Ambil data dengan paginasi
        return view('user.peminjaman.histori', compact('peminjaman'));
    }



    public function index(Request $request)
    {
        $peminjaman = Buku::orderBy('jumlah_buku', 'desc')->paginate(5);
        $user = Auth::user();

        // Query dasar
        $query = Peminjaman_buku::where('nama_peminjam', $user->name)
            ->whereIn('status', ['ditahan', 'diterima', 'ditolak']);

        // Filter berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $buku = Buku::all();
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        $penerbit = Penerbit::all();
        $peminjaman = Peminjaman_buku::where('nama', $user->name)->latest()->paginate(10);
        return view('user.peminjaman.index', compact('buku', 'kategori', 'penulis', 'penerbit', 'peminjaman', 'user'));
    }
    public function indexAdmin()
    {
        $buku = Buku::all();
        $user = Auth::user();
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        $penerbit = Penerbit::all();
        $peminjaman = Peminjaman_buku::with('user', 'buku')->latest()->paginate(10);
        return view('admin.peminjamanadmin.index', compact('buku', 'kategori', 'penulis', 'penerbit', 'peminjaman', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buku = Buku::all();
        $user = User::all();
        $peminjaman = Peminjaman_buku::all();

        $batastanggal = Carbon::now()->addWeek()->format('Y-m-d');
        $sekarang = now()->format('Y-m-d');

        return view('user.peminjaman.create', compact('peminjaman', 'buku', 'sekarang', 'batastanggal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'jumlah' => 'required|min:1|max:1000',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date',
            'nama' => 'required',
            // 'status' => 'required',
            'id_buku' => 'required',
        ]);

        // Mencari data buku berdasarkan ID yang diberikan
        $buku = Buku::findOrFail($request->id_buku);

        // Cek apakah jumlah yang diminta lebih dari stok buku yang tersedia
        if ($request->jumlah > $buku->jumlah_buku) {
            // Jika lebih, tampilkan SweetAlert dengan pesan error
            Alert::error('Error', 'Quantity requested exceeds available stock')->autoclose(1500);
            return redirect()->back();
        }

        // Jika jumlah cukup, lanjutkan dengan menyimpan data peminjaman
        $peminjaman = new Peminjaman_buku();
        $peminjaman->jumlah = $request->jumlah;
        $peminjaman->tgl_pinjam = $request->tgl_pinjam;
        $peminjaman->batas_tanggal = $request->batas_tanggal;
        $peminjaman->tgl_kembali = $request->tgl_kembali;
        $peminjaman->alasan = $request->alasan;
        $peminjaman->nama = Auth::user()->name;
        $peminjaman->status = 'ditahan';
        $peminjaman->id_buku = $request->id_buku;
        // $peminjaman->id_user = $request->id_user


        // Kurangi stok buku sesuai dengan jumlah yang dipinjam
        $buku->stok -= $request->stok;
        $buku->save();

        // Simpan data peminjaman
        $peminjaman->save();

        // Tampilkan SweetAlert dengan pesan sukses
        Alert::info('Info!', 'Loan application successfully created and still in hold status')->autoclose(1500);

        // Redirect ke halaman index peminjaman
        return redirect()->route('peminjaman.index');
    }


    public function showpengajuanuser($id)
    {
        $peminjaman = Peminjaman_buku::findOrFail($id);
        $buku = Buku::all();
        $user = Auth::user();
        return view('user.peminjaman.showpengajuan', compact('user', 'buku', 'peminjaman'));
    }
    public function show($id)
    {
        $peminjaman = Peminjaman_buku::with('buku')->findOrFail($id);
        return view('admin.peminjamanadmin.detail', compact('peminjaman'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::all();
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        $user = User::all();
        $penerbit = Penerbit::all();
        $peminjaman = Peminjaman_buku::findOrFail($id);
        return view('user.peminjaman.edit', compact('peminjaman', 'buku', 'kategori', 'penulis', 'penerbit', 'user'));
    }


    public function update(Request $request, $id)
    {
        // Temukan objek peminjaman berdasarkan ID
        $peminjaman = Peminjaman_buku::findOrFail($id);
        $peminjaman->alasan = $request->alasan;
        $status = $request->input('status');
        $buku = Buku::findOrFail($peminjaman->id_buku);

        // Terapkan logika berdasarkan status
        if ($status === 'diterima') {
            // Kurangi stok buku jika diterima
            $buku->jumlah_buku -= $peminjaman->jumlah;
            $buku->save();
            $peminjaman->status = 'diterima';
            Alert::success('Accepted', 'your book loan has been approved by the admin')->autoclose(1500);

        } elseif ($status === 'ditahan') {
            // Tambah stok buku jika ditahan
            $buku->jumlah_buku += $peminjaman->jumlah;
            $buku->save();
            $peminjaman->status = 'ditahan';
            Alert::info('On hold', 'Book loan is still in admin submission process')->autoclose(1500);

        } elseif ($status === 'ditolak') {
            // Tidak ada perubahan pada stok buku jika ditolak
            $peminjaman->status = 'ditolak';
            Alert::error('Rejected', 'Book loan rejected by admin')->autoclose(1500);

        } elseif ($status === 'dikembalikan') {
            // Tambah stok buku jika dikembalikan
            $buku->jumlah_buku += $peminjaman->jumlah;
            $buku->save();
            Alert::success('Book returned', 'borrowed book has been returned')->autoclose(1500);

        } else {
            // Jika status tidak dikenal
            Alert::info('On hold', 'Book loan is still in admin submission process')->autoclose(1500);
        }

        // Simpan perubahan pada objek peminjaman
        $peminjaman->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Loan status successfully updated');
    }


    public function destroy($id)
    {
        $peminjaman = Peminjaman_buku::findOrFail($id);
        $peminjaman->delete();
        return redirect()->route('peminjamanadmin.index');
    }
}
