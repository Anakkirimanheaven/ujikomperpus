<?php
namespace App\Http\Controllers;

use App\Models\Favorit;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritController extends Controller
{
    public function index()
    {
        $favorit = Auth::user()->favoritBooks()->get();
        return view('favorit.index', compact('favorit'));
    }

    public function store(Buku $buku)
    {
        $favorit = Favorit::firstOrCreate([
            'id_user' => Auth::id(),
            'id_buku' => $buku->id,
        ]);

        return back()->with('success', 'Buku ditambahkan ke favorit!');
    }

    public function destroy(Buku $buku)
    {
        $favorit = Favorit::where('id_user', Auth::id())->where('id_buku', $buku->id)->first();

        if ($favorit) {
            $favorit->delete();
            return back()->with('success', 'Buku dihapus dari favorit!');
        }

        return back()->with('error', 'Buku tidak ditemukan dalam daftar favorit.');
    }
}
