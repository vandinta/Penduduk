<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProvinsiController extends Controller
{
    public function index()
    {
        $no = 1;
        $provinsi = DB::table('tb_provinsi')->paginate(10);
        return view('provinsi.index', compact('no', 'provinsi'));
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        
        $no = 1;
		$provinsi = DB::table('tb_provinsi')->where('nama_provinsi','like',"%".$search."%")->paginate(10);
        
        return view('provinsi.index', compact('no', 'provinsi'));
    }

    public function create()
    {
        return view('provinsi.tambah');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_provinsi' => 'required|alpha:ascii',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $provinsi = Provinsi::create([
            'nama_provinsi' => $request->nama_provinsi,
        ]);

        if ($provinsi) {
            Session::flash('berhasil', 'Berhasil Menambah Data');
            return redirect()->route('provinsi.index');
        }
        Session::flash('gagal', 'gagal Menambah Data');
        return redirect()->back();
    }

    public function edit(Provinsi $provinsi)
    {
        return view('provinsi.edit', compact('provinsi'));
    }

    public function update(Request $request, Provinsi $provinsi)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_provinsi' => 'required|alpha:ascii',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $provinsi->update($request->all());

        if ($provinsi) {
            Session::flash('berhasil', 'Berhasil Mengubah Data');
            return redirect()->route('provinsi.index');
        }

        Session::flash('gagal', 'gagal Mengubah Data');
        return redirect()->back();
    }

    public function destroy(Provinsi $provinsi)
    {
        $provinsi->delete();

        if ($provinsi) {
            Session::flash('berhasil', 'Berhasil Menghapus Data');
            return redirect()->route('provinsi.index');
        }

        Session::flash('gagal', 'gagal Menghapus Data');
        return redirect()->back();
    }
}
