<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenulisController extends Controller
{
    public function index()
    {
        try {
            $data = \DB::table('penulis')->orderBy('username')->get();

            return view('penulis.index', compact('data'));
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            return back()->withError('Terjadi kesalahan pada database');
        }
    }

    public function update($id, Request $request)
    {
        try {
            \DB::table('penulis')->where('id', $id)->update([
                'active' => (int) $request->active
            ]);

            return redirect('/penulis')->withStatus('Berhasil menyimpan perubahan');
        } catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database');
        }
    }
}
