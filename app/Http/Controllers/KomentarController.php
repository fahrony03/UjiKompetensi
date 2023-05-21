<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KomentarController extends Controller
{
    public function index()
    {
        if (Session::get('role') == 'admin') {
            $data = \DB::table('detail')->select(
                'detail.*',
                'a.judul_artikel',
                'k.nama',
                'k.email',
                'k.isi_komentar'
            )
            ->join('artikel AS a', 'a.id', 'detail.id_artikel')
            ->join('komentar AS k', 'k.id', 'detail.id_komentar')
            ->orderBy('detail.id', 'desc')
            ->get();
        }
        else {
            $data = \DB::table('detail')->select(
                'detail.*',
                'a.judul_artikel',
                'k.nama',
                'k.email',
                'k.isi_komentar'
            )
            ->join('artikel AS a', 'a.id', 'detail.id_artikel')
            ->join('komentar AS k', 'k.id', 'detail.id_komentar')
            ->where('a.id_penulis', Session::get('id'))
            ->orderBy('detail.id', 'desc')
            ->get();
        }

        return view('komentar.index', compact('data'));
    }
}
