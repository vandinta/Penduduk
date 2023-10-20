<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Support\Facades\DB;
use App\Exports\PendudukExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::all();

        return view('laporan.index', compact('provinsi', 'kabupaten'));
    }

    public function print(Request $request)
    {
        $no = 1;
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::all();

        if ($request->printprovinsi != null && $request->printkabupaten != null) {
            $penduduk = DB::table('tb_penduduk')->join('tb_provinsi', 'tb_penduduk.id_provinsi', '=', 'tb_provinsi.id')->join('tb_kabupaten', 'tb_penduduk.id_kabupaten', '=', 'tb_kabupaten.id')->where('tb_penduduk.id_provinsi', $request->printprovinsi)->where('tb_penduduk.id_kabupaten', $request->printkabupaten)->select('tb_penduduk.*', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten')->get();
        } elseif ($request->printprovinsi != null && $request->printkabupaten == null) {
            $penduduk = DB::table('tb_penduduk')->join('tb_provinsi', 'tb_penduduk.id_provinsi', '=', 'tb_provinsi.id')->join('tb_kabupaten', 'tb_penduduk.id_kabupaten', '=', 'tb_kabupaten.id')->where('tb_penduduk.id_provinsi', '=', $request->printprovinsi)->get();
        } else {
            $penduduk = DB::table('tb_penduduk')->join('tb_provinsi', 'tb_penduduk.id_provinsi', '=', 'tb_provinsi.id')->join('tb_kabupaten', 'tb_penduduk.id_kabupaten', '=', 'tb_kabupaten.id')->select('tb_penduduk.*', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten')->get();
        }

        return view('laporan.print', compact('no', 'penduduk', 'provinsi', 'kabupaten'));
    }

    public function excel(Request $request)
    {
        $provinsi = $request->excelprovinsi;
        $kabupaten = $request->excelkabupaten;

        return Excel::download(new PendudukExport($provinsi, $kabupaten), 'data-penduduk.xlsx');
    }
}
