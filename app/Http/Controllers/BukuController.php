<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Buku;
use App\Models\Komentar;

use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    // Menghubungkan Buku dengan authentication login
    public function __construct()
    {
        $this->middleware('admin');
    }

    // fungsi index -> menampilkan data atau halaman index.blade
    public function index() {
        // $data_buku = Buku::all();

        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('judul')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('index', compact('data_buku', 'no', 'jumlah_buku'));
    }

    // fungsi search -> menampilkan data yang dicari
    public function search(Request $request) {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis', 'like', "%".$cari."%")->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('search', compact('jumlah_buku', 'data_buku', 'no', 'cari'));
    }

    // fungsi create -> menampilkan create.blade
    public function create() {
        return view('create');
    }

    // fungsi store -> fungsi untuk tombol Simpan
    public function store(Request $request) {
        $this->validate($request,[
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date'
        ]);

        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->buku_seo = Str::slug($request->judul, '-');
        $buku->save();

        return redirect('/buku')->with('pesan2', 'Data Buku Berhasil Ditambah');
    }

    // fungsi destroy -> untuk menghapus data buku dan memperbarui halaman index.blade
    public function destroy($id) {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('pesan1', 'Data Buku Berhasi Dihapus');
    }

    // 
    public function show($id) {
        $buku = Buku::find($id);
        return view('update', compact('buku'));
    }

    // 
    public function update(Request $request, $id) {
        $this->validate($request,[
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date'
        ]);

        $buku = Buku::find($id);
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Di-update');
    }

    // SEO
    
    public function galbuku($bukuSeo) {
        $buku = Buku::where('buku_seo', $bukuSeo)->first();
        $galeri = $buku->photos()->orderBy('id', 'desc')->paginate(6);
        $komentar = $buku->comment()->paginate(10);

        return view('detail-buku', compact('buku', 'galeri', 'komentar'));
    }

    // Like
    
    public function likefoto(Request $request, $id) {
        $buku = Buku::find($id);
        $buku->increment('like');

        return back();
    }
}
