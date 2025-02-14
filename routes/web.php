<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TakaanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanBukuController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isAdmin;
// use App\Http\Controllers\EmailController;
use App\Http\Controllers\FilterBukuController;
use App\Http\Controllers\FavoritController;
use App\Http\Middleware\IsPetugas;

Route::get('/', function () {
    return view('layouts.backend.admin');
})->middleware('auth');

// Rute yang hanya bisa diakses oleh admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin:admin,petugas']], function () {
    Route::get('home', [DashboardController::class, 'index'])->name('home');
    Route::resource('kategori', KategoriController::class);
    Route::resource('penerbit', PenerbitController::class);
    Route::resource('penulis', PenulisController::class);
    Route::resource('buku', BukuController::class);
    Route::resource('user', UserController::class);

    Route::get('peminjaman', [PeminjamanBukuController::class, 'indexadmin'])->name('peminjamanadmin.index');
    Route::get('peminjaman/{id}/detail', [PeminjamanBukuController::class, 'show'])->name('peminjamanadmin.detail');
});


// Route::get('', [TakaanController::class, 'index'])->name('halamanuser');
Route::get('filter/kategori/{id}', [FilterBukuController::class, 'filterkategori'])->name('kategori.filter');
Route::get('filter/penerbit/{id}', [FilterBukuController::class, 'filterpenerbit'])->name('penerbit.filter');
Route::get('filter/penulis/{id}', [FilterBukuController::class, 'filterpenulis'])->name('penulis.filter');

Route::group(['prefix' => 'peminjam'], function () {
    Route::get('buku', [TakaanController::class, 'buku'])->name('buku');
    Route::get('show/{id}', [TakaanController::class, 'show'])->name('show');
    Route::get('profile', [TakaanController::class, 'profile'])->name('profile');
    Route::get('dashboarduser', [TakaanController::class, 'dashboard'])->name('dashboarduser');
    Route::get('peminjaman/history', [PeminjamanBukuController::class, 'history'])->name('peminjaman.history');
    Route::get('detail/buku/{id}', [BukuController::class, 'detailBuku'])->name('detail.buku');
    Route::get('/dashboarduser', [HomeController::class, 'index'])->name('dashboarduser');

});

Route::group(['prefix' => 'petugas', 'middleware' => ['auth', isPetugas::class]], function () {
    Route::get('', [App\Http\Controllers\Petugas\PetugasController::class, 'index'])->name('petugasdashboard');
    Route::resource('kategori', App\Http\Controllers\Petugas\KategoriController::class, ['as' => 'petugas']);
    Route::resource('penerbit', App\Http\Controllers\Petugas\PenerbitController::class, ['as' => 'petugas']);
    Route::resource('penulis', App\Http\Controllers\Petugas\PenulisController::class, ['as' => 'petugas']);
    Route::resource('buku', App\Http\Controllers\Petugas\BukuController::class, ['as' => 'petugas']);
});

Route::group(['prefix' => 'peminjam', 'middleware' => ['auth']], function () {
    Route::resource('peminjaman', PeminjamanBukuController::class);
    Route::resource('pengembalian', PengembalianController::class);
    Route::get('pengajuan/show/{id}', [PeminjamanBukuController::class, 'showpengajuanuser'])->name('showpengajuanuser');
    Route::resource('favorit', FavoritController::class);
    // Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    // Route::post('/favorites/{book}', [FavoriteController::class, 'store'])->name('favorites.store');
    // Route::get('pengajuan/show/{id}',[MinjemController::class, 'showpengajuanuser'])->name('showpengajuanuser');
});


Auth::routes();

Route::get('/send-email', [EmailController::class, 'sendEmail']);
