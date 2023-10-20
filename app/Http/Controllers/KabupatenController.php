<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class KabupatenController extends Controller
{
    public function index()
    {
        $no = 1;
        $provinsi = Provinsi::all();
        $kabupaten = DB::table('tb_kabupaten')->join('tb_provinsi', 'tb_kabupaten.id_provinsi', '=', 'tb_provinsi.id')->select('tb_kabupaten.*', 'tb_provinsi.nama_provinsi')->paginate(10);
        
        return view('kabupaten.index', compact('no', 'provinsi', 'kabupaten'));
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        
        $no = 1;
        $provinsi = Provinsi::all();

        if ($request->provinsi != null && $search != null) {
            $kabupaten = DB::table('tb_kabupaten')->join('tb_provinsi', 'tb_kabupaten.id_provinsi', '=', 'tb_provinsi.id')->where('tb_kabupaten.id_provinsi', $request->provinsi)->where('nama_kabupaten','like',"%".$search."%")->select('tb_kabupaten.*', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten')->paginate(10);
        } elseif ($request->provinsi != null && $search == null) {
            $kabupaten = DB::table('tb_kabupaten')->join('tb_provinsi', 'tb_kabupaten.id_provinsi', '=', 'tb_provinsi.id')->where('tb_kabupaten.id_provinsi','=', $request->provinsi)->select('tb_kabupaten.*', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten')->paginate(10);
        } elseif ($request->provinsi == null && $search != null) {
            $kabupaten = DB::table('tb_kabupaten')->join('tb_provinsi', 'tb_kabupaten.id_provinsi', '=', 'tb_provinsi.id')->where('nama_kabupaten','like',"%".$search."%")->select('tb_kabupaten.*', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten')->paginate(10);
        } else {
            $kabupaten = DB::table('tb_kabupaten')->join('tb_provinsi', 'tb_kabupaten.id_provinsi', '=', 'tb_provinsi.id')->select('tb_kabupaten.*', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten')->paginate(10);
        }
        
        return view('kabupaten.index', compact('no', 'provinsi', 'kabupaten'));
    }

    public function create()
    {
        $provinsi = Provinsi::all();
        return view('kabupaten.tambah', compact('provinsi'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_kabupaten' => 'required|alpha:ascii',
                'id_provinsi' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $kabupaten = Kabupaten::create([
            'nama_kabupaten' => $request->nama_kabupaten,
            'id_provinsi' => $request->id_provinsi,
        ]);

        if ($kabupaten) {
            Session::flash('berhasil', 'Berhasil Menambah Data');
            return redirect()->route('kabupaten.index');
        }
        Session::flash('gagal', 'gagal Menambah Data');
        return redirect()->back();
    }

    public function edit(Kabupaten $kabupaten)
    {
        $provinsi = Provinsi::all();
        return view('kabupaten.edit', compact('provinsi', 'kabupaten'));
    }

    public function update(Request $request, Kabupaten $kabupaten)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_kabupaten' => 'required|alpha:ascii',
                'id_provinsi' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $kabupaten->update($request->all());

        if ($kabupaten) {
            Session::flash('berhasil', 'Berhasil Mengubah Data');
            return redirect()->route('kabupaten.index');
        }

        Session::flash('gagal', 'gagal Mengubah Data');
        return redirect()->back();
    }

    public function destroy(Kabupaten $kabupaten)
    {
        $kabupaten->delete();

        if ($kabupaten) {
            Session::flash('berhasil', 'Berhasil Menghapus Data');
            return redirect()->route('kabupaten.index');
        }

        Session::flash('gagal', 'gagal Menghapus Data');
        return redirect()->back();
    }
}
