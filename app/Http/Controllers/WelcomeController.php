<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->q)
            $data = \DB::table('artikel')->where('judul_artikel', 'LIKE', '%'.$request->q.'%')->orderBy('judul_artikel')->get();
        else
            $data = \DB::table('artikel')->orderBy('judul_artikel')->get();

        return view('home', compact('data'));
    }

    public function show($id)
    {
        try {
            $data = \DB::table('artikel')->where('id', $id)->first();

            return view('detail', compact('data'));
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database');
        }
    }

    public function storeKomentar(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'komentar' => 'required',
        ], [
            'required' => ':attribute harus diisi.'
        ], [
            'nama' => 'Nama',
            'email' => 'Email',
            'komentar' => 'Komentar'
        ]);

        try {
            \DB::beginTransaction();
            
            $komentar = \DB::table('komentar')->insertGetId([
                'nama' => $request->nama,
                'email' => $request->email,
                'isi_komentar' => $request->komentar
            ]);

            \DB::table('detail')->insert([
                'id_artikel' => $request->id_artikel,
                'id_komentar' => $komentar,
            ]);

            \DB::commit();

            return redirect('/')->withStatus('Berhasil mengirim komentar');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            \DB::rollBack();
            return back()->withError('Terjadi kesalahan');
        }
    }
}
