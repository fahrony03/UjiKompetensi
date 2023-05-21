<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('role') == 'admin')
            $data = \DB::table('artikel')->orderBy('id', 'desc')->get();
        else
            $data = \DB::table('artikel')->where('id_penulis', Session::get('id'))->orderBy('id', 'desc')->get();

        return view('artikel.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artikel.create');
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
            'judul' => 'required',
            'konten' => 'required'
        ], [
            'required' => ':attribute harus diisi.',
        ], [
            'judul' => 'Judul',
            'konten' => 'Konten'
        ]);

        try {
            \DB::table('artikel')->insert([
                'judul_artikel' => $request->judul,
                'isi_artikel' => $request->konten,
                'id_penulis' => Session::get('id'),
                'tanggal' => date('Y-m-d')
            ]);

            return redirect('/artikel')->withStatus('Berhasil menyimpan data');
        } catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database');
        }
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
        try {
            $data = \DB::table('artikel')->where('id', $id)->first();

            return view('artikel.edit', compact('data'));
        } catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database');
        }
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
        $this->validate($request, [
            'judul' => 'required',
            'konten' => 'required'
        ], [
            'required' => ':attribute harus diisi.',
        ], [
            'judul' => 'Judul',
            'konten' => 'Konten'
        ]);

        try {
            \DB::table('artikel')->where('id', $id)->update([
                'judul_artikel' => $request->judul,
                'isi_artikel' => $request->konten,
            ]);

            return redirect('/artikel')->withStatus('Berhasil menyimpan data');
        } catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            \DB::table('artikel')->where('id', $id)->delete();

            return back()->withStatus('Berhasil menghapus data');
        } catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database');
        }
    }
}
