<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        if (Session::get('role') == 'admin') {
            $artikel = \DB::table('artikel')->orderBy('id', 'desc')->limit(5)->get();
            $totalArtikel = \DB::table('artikel')->count();
            $totalKomentar = \DB::table('komentar')->count();
            $totalPenulis = \DB::table('penulis')->count();
        }
        else {
            $artikel = \DB::table('artikel')->where('id_penulis', Session::get('id'))->orderBy('id', 'desc')->limit(5)->get();
            $totalArtikel = \DB::table('artikel')->where('id_penulis', Session::get('id'))->count();
            $totalKomentar = \DB::table('detail')
            ->join('artikel AS a', 'a.id', 'detail.id_artikel')
            ->join('komentar AS k', 'k.id', 'detail.id_komentar')
            ->where('a.id_penulis', Session::get('id'))
            ->count();
            $totalPenulis = \DB::table('penulis')->where('id', Session::get('id'))->count();
        }

        $data = [
            'artikel' => $artikel,
            'total_artikel' => $totalArtikel,
            'total_komentar' => $totalKomentar,
            'total_penulis' => $totalPenulis,
        ];

        return view('dashboard', $data);
    }
}
