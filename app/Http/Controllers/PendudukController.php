<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    public function index()
    {
        $no = 1;
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::all();
        $penduduk = DB::table('tb_penduduk')->join('tb_provinsi', 'tb_penduduk.id_provinsi', '=', 'tb_provinsi.id')->join('tb_kabupaten', 'tb_penduduk.id_kabupaten', '=', 'tb_kabupaten.id')->select('tb_penduduk.*', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten')->paginate(10);
        
        return view('penduduk.index', compact('no', 'penduduk', 'provinsi', 'kabupaten'));
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        
        $no = 1;
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::all();

        if ($request->provinsi != null && $request->kabupaten != null && $search != null) {
            $penduduk = DB::table('tb_penduduk')->join('tb_provinsi', 'tb_penduduk.id_provinsi', '=', 'tb_provinsi.id')->join('tb_kabupaten', 'tb_penduduk.id_kabupaten', '=', 'tb_kabupaten.id')->where('tb_penduduk.id_provinsi', $request->provinsi)->where('tb_penduduk.id_kabupaten', $request->kabupaten)->where('nama','like',"%".$search."%")->select('tb_penduduk.*', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten')->paginate(10);
        } elseif ($request->provinsi != null && $request->kabupaten != null && $search == null) {
            $penduduk = DB::table('tb_penduduk')->join('tb_provinsi', 'tb_penduduk.id_provinsi', '=', 'tb_provinsi.id')->join('tb_kabupaten', 'tb_penduduk.id_kabupaten', '=', 'tb_kabupaten.id')->where('tb_penduduk.id_provinsi','=', $request->provinsi)->where('tb_penduduk.id_kabupaten','=', $request->kabupaten)->select('tb_penduduk.*', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten')->paginate(10);
        } elseif ($request->provinsi != null && $request->kabupaten == null && $search == null) {
            $penduduk = DB::table('tb_penduduk')->join('tb_provinsi', 'tb_penduduk.id_provinsi', '=', 'tb_provinsi.id')->join('tb_kabupaten', 'tb_penduduk.id_kabupaten', '=', 'tb_kabupaten.id')->where('tb_penduduk.id_provinsi','=', $request->provinsi)->select('tb_penduduk.*', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten')->paginate(10);
        } elseif ($request->provinsi == null && $request->kabupaten == null && $search != null) {
            $penduduk = DB::table('tb_penduduk')->join('tb_provinsi', 'tb_penduduk.id_provinsi', '=', 'tb_provinsi.id')->join('tb_kabupaten', 'tb_penduduk.id_kabupaten', '=', 'tb_kabupaten.id')->select('tb_penduduk.*', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten')->where('nama','like',"%".$search."%")->paginate(10);
        } else {
            $penduduk = DB::table('tb_penduduk')->join('tb_provinsi', 'tb_penduduk.id_provinsi', '=', 'tb_provinsi.id')->join('tb_kabupaten', 'tb_penduduk.id_kabupaten', '=', 'tb_kabupaten.id')->select('tb_penduduk.*', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten')->paginate(10);
        }
        
        return view('penduduk.index', compact('no', 'penduduk', 'provinsi', 'kabupaten'));
    }

    public function create()
    {
        $provinsi = Provinsi::all();
        return view('penduduk.tambah', compact('provinsi'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required|alpha:ascii',
                'nik' => 'required|max:18',
                'jeniskelamin' => 'required',
                'tanggallahir' => 'required',
                'alamat' => 'required',
                'provinsi' => 'required',
                'kabupaten' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $penduduk = penduduk::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jeniskelamin' => $request->jeniskelamin,
            'tanggallahir' => $request->tanggallahir,
            'alamat' => $request->alamat,
            'id_provinsi' => $request->provinsi,
            'id_kabupaten' => $request->kabupaten,
        ]);

        if ($penduduk) {
            Session::flash('berhasil', 'Berhasil Menambah Data');
            return redirect()->route('penduduk.index');
        }
        Session::flash('gagal', 'gagal Menambah Data');
        return redirect()->back();
    }

    public function edit(Penduduk $penduduk)
    {
        $provinsi = Provinsi::all();
        $kabupaten = DB::table('tb_kabupaten')->where('id_provinsi', $penduduk->id_provinsi)->get(); 
        return view('penduduk.edit', compact('provinsi', 'kabupaten', 'penduduk'));
    }

    public function update(Request $request, penduduk $penduduk)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required|alpha:ascii',
                'nik' => 'required|max:18',
                'jeniskelamin' => 'required',
                'tanggallahir' => 'required',
                'alamat' => 'required',
                'provinsi' => 'required',
                'kabupaten' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $penduduk->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jeniskelamin' => $request->jeniskelamin,
            'tanggallahir' => $request->tanggallahir,
            'alamat' => $request->alamat,
            'id_provinsi' => $request->provinsi,
            'id_kabupaten' => $request->kabupaten,
        ]);

        if ($penduduk) {
            Session::flash('berhasil', 'Berhasil Mengubah Data');
            return redirect()->route('penduduk.index');
        }

        Session::flash('gagal', 'gagal Mengubah Data');
        return redirect()->back();
    }

    public function destroy(penduduk $penduduk)
    {
        $penduduk->delete();

        if ($penduduk) {
            Session::flash('berhasil', 'Berhasil Menghapus Data');
            return redirect()->route('penduduk.index');
        }

        Session::flash('gagal', 'gagal Menghapus Data');
        return redirect()->back();
    }
}
