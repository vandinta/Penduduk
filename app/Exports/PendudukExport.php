<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendudukExport implements FromCollection, WithHeadings
{
    protected $provinsi;
    protected $kabupaten;

    public function __construct($provinsi, $kabupaten)
    {
        $this->provinsi = $provinsi;
        $this->kabupaten = $kabupaten;
    }

    public function headings(): array
    {
        return ["ID", "Nama", "NIK", "Tanggal Lahir", "Jenis Kelamin", "Alamat", "Kabupaten", "Provinsi", "Dibuat Pada", "Diupdate Pada"];
    }

    public function collection()
    {
        if ($this->provinsi != null && $this->kabupaten != null) {
            $penduduk = DB::table('tb_penduduk')->join('tb_provinsi', 'tb_penduduk.id_provinsi', '=', 'tb_provinsi.id')->join('tb_kabupaten', 'tb_penduduk.id_kabupaten', '=', 'tb_kabupaten.id')->where('tb_penduduk.id_provinsi', $this->provinsi)->where('tb_penduduk.id_kabupaten', $this->kabupaten)->select('tb_penduduk.id', 'tb_penduduk.nama', 'tb_penduduk.nik', 'tb_penduduk.tanggallahir', 'tb_penduduk.jeniskelamin', 'tb_penduduk.alamat', 'tb_kabupaten.nama_kabupaten', 'tb_provinsi.nama_provinsi', 'tb_penduduk.created_at', 'tb_penduduk.updated_at');
        } elseif ($this->provinsi != null && $this->kabupaten == null) {
            $penduduk = DB::table('tb_penduduk')->join('tb_provinsi', 'tb_penduduk.id_provinsi', '=', 'tb_provinsi.id')->join('tb_kabupaten', 'tb_penduduk.id_kabupaten', '=', 'tb_kabupaten.id')->where('tb_penduduk.id_provinsi','=', $this->provinsi)->select('tb_penduduk.id', 'tb_penduduk.nama', 'tb_penduduk.nik', 'tb_penduduk.tanggallahir', 'tb_penduduk.jeniskelamin', 'tb_penduduk.alamat', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten', 'tb_penduduk.created_at', 'tb_penduduk.updated_at');;
        } else {
            $penduduk = DB::table('tb_penduduk')->join('tb_provinsi', 'tb_penduduk.id_provinsi', '=', 'tb_provinsi.id')->join('tb_kabupaten', 'tb_penduduk.id_kabupaten', '=', 'tb_kabupaten.id')->select('tb_penduduk.id', 'tb_penduduk.nama', 'tb_penduduk.nik', 'tb_penduduk.tanggallahir', 'tb_penduduk.jeniskelamin', 'tb_penduduk.alamat', 'tb_provinsi.nama_provinsi', 'tb_kabupaten.nama_kabupaten', 'tb_penduduk.created_at', 'tb_penduduk.updated_at');
        }

        return $penduduk->get();
    }
}