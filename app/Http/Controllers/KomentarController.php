<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request, $idBuku) {
        $this->validate($request,[
            'comment' => 'required'
        ]);
        
        $komentar = new Komentar;
        $komentar->id_user = Auth::id();
        $komentar->id_buku = $idBuku;
        $komentar->comment = $request->comment;
        $komentar->save();

        return back();
    }
}
