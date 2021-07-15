<?php

namespace App\Imports;

use App\Models\Presensi_harian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PresensiCsvImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Presensi_harian([
            //
            'id_pegawai'      =>  $row["id_pegawai"],
            'tanggal'      =>  $row["tanggal"],
            'ket'      =>  $row["ket"],
            'jam_dtg'      =>  $row["jam_dtg"],
            'jam_plg'      =>  $row["jam_plg"],
            'is_wfh'      =>  $row["is_wfh"],
        ]);
    }
}
