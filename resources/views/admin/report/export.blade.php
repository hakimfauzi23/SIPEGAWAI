<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <tr>
            <td align="center" colspan="6">REKAP KINERJA PEGAWAI SELAMA TAHUN {{ $tahun }}</td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td>ID Pegawai</td>
            <td align="right">:</td>
            <td align="left">{{ $pegawai->id }}</td>
            <td>Jabatan</td>
            <td align="right">:</td>
            <td align="left">{{ $pegawai->jabatan->nm_jabatan }}</td>
        </tr>
        <tr>
            <td>Nama Pegawai</td>
            <td align="right">:</td>
            <td align="left">{{ $pegawai->nama }}</td>
            <td>Divisi</td>
            <td align="right">:</td>
            <td align="left">{{ $pegawai->divisi->nm_divisi }}</td>
        </tr>
        <tr></tr>
        <tr></tr>

        <table class="presensi">
            <tr>
                <td rowspan="2" colspan="6" valign="center" align="center" style="background-color: #ff8400">
                    Presensi Pegawai
                </td>
            </tr>
            <tr></tr>


            <tr>
                <td rowspan="2" colspan="3" valign="center" align="center" style="background-color: #bdb5ad">
                    Bulan
                </td>
                <td rowspan="2" colspan="3" valign="center" align="center" style="background-color: #bdb5ad">
                    Keterangan
                </td>
            </tr>
            <tr></tr>
            @foreach ($months as $value => $key)
                <tr>
                    <td rowspan="4" colspan="3" valign="center" align="center" @if ($key % 2 == 0) style="background-color: #e6e6e6"  
@else 
                    style="background-color: #979797" @endif>
                        {{ $value }}
                    </td>
                    <td align="left" style="background-color: #ffcc00">
                        Jumlah Terlambat
                    </td>
                    <td style="background-color: #ffcc00">
                        :
                    </td>
                    <td align="left" style="background-color: #ffcc00">
                        {{ $Telat[$key] }}
                    </td>
                </tr>
                <tr>
                    <td align="left" style="background-color: #ffcc00">
                        Jumlah Pulang Awal
                    </td>
                    <td style="background-color: #ffcc00">
                        :
                    </td>
                    <td align="left" style="background-color: #ffcc00">
                        {{ $Awal[$key] }}
                    </td>
                </tr>
                <tr>
                    <td align="left" style="background-color: #ffcc00">
                        Kehadiran
                    </td>
                    <td style="background-color: #ffcc00">
                        :
                    </td>
                    <td align="left" style="background-color: #ffcc00">
                        {{ $Hadir[$key] + $Cuti[$key] . ' / ' . ($Hadir[$key] + $Alpha[$key] + $Cuti[$key]) }}
                    </td>
                </tr>
                <tr>
                    <td align="left" style="background-color: #ffcc00">
                        Persentase Kehadiran
                    </td>
                    <td style="background-color: #ffcc00">
                        :
                    </td>
                    <td align="left" style="background-color: #ffcc00">
                        {{ number_format($Hadir[$key] + $Alpha[$key] + $Cuti[$key] != 0 ? (($Hadir[$key] + $Cuti[$key]) / ($Hadir[$key] + $Alpha[$key] + $Cuti[$key])) * 100 : 0, 2) }}
                        {{-- {{ number_format($Hadir[$key] + $Alpha[$key] + $Cuti[$key] != 0 ? (16 / ($Hadir[$key] + $Alpha[$key] + $Cuti[$key])) * 100 : 0, 2) }} --}}
                        %
                    </td>
                </tr>
            @endforeach
        </table>
        <table class="cuti">
            <tr>
                <td rowspan="2" colspan="6" valign="center" align="center" style="background-color: #ff8400">
                    Cuti Pegawai
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td rowspan="2" colspan="3" valign="center" align="center" style="background-color: #bdb5ad">
                    Jenis Cuti
                </td>
                <td rowspan="2" colspan="3" valign="center" align="center" style="background-color: #bdb5ad">
                    Cuti Terpakai / Batas Cuti Maksimal
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td colspan="3" valign="center" align="center" style="background-color: #e6e6e6;height:30px">
                    Cuti Tahunan
                </td>
                <td colspan="3" valign="center" align="center" style="background-color: #e6e6e6;height:30px">
                    {{ $Tahunan . ' / ' . $batasTahunan }}
                </td>
            </tr>
            <tr>
                <td colspan="3" valign="center" align="center" style="background-color: #979797;height:30px">
                    Cuti Bersama
                </td>
                <td colspan="3" valign="center" align="center" style="background-color: #979797;height:30px">
                    {{ $Bersama . ' / ' . $batasBersama }}
                </td>
            </tr>
            <tr>
                <td colspan="3" valign="center" align="center" style="background-color: #e6e6e6;height:30px">
                    Cuti Penting
                </td>
                <td colspan="3" valign="center" align="center" style="background-color: #e6e6e6;height:30px">
                    {{ $Penting . ' / ' . $batasPenting }}
                </td>
            </tr>
            <tr>
                <td colspan="3" valign="center" align="center" style="background-color: #979797;height:30px">
                    Cuti Sakit
                </td>
                <td colspan="3" valign="center" align="center" style="background-color: #979797;height:30px">
                    {{ $Sakit . ' / ' . $batasSakit }}
                </td>
            </tr>
            <tr>
                <td colspan="3" valign="center" align="center" style="background-color: #e6e6e6;height:30px">
                    Cuti Besar
                </td>
                <td colspan="3" valign="center" align="center" style="background-color: #e6e6e6;height:30px">
                    {{ $Besar . ' / ' . $batasBesar }}
                </td>
            </tr>
            @if ($pegawai->jk == 'Wanita')
                <tr>
                    <td colspan="3" valign="center" align="center" style="background-color: #979797;height:30px">
                        Cuti Hamil
                    </td>
                    <td colspan="3" valign="center" align="center" style="background-color: #979797;height:30px">
                        {{ $Hamil . ' / ' . $batasHamil }}
                    </td>
                </tr>
            @endif
        </table>
        <table class="surat-peringatan">
            <tr>
                <td rowspan="2" colspan="6" valign="center" align="center" style="background-color: #ff8400">
                    Riwayat Surat Peringatan
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td rowspan="2" colspan="2" valign="center" align="center" style="background-color: #bdb5ad">
                    Tanggal
                </td>
                <td rowspan="2" valign="center" align="center" style="background-color: #bdb5ad">
                    Tingkat
                </td>
                <td rowspan="2" colspan="3" valign="center" align="center" style="background-color: #bdb5ad">
                    Keterangan Diberi SP
                </td>
            </tr>
            <tr></tr>
            @if (count($suratPeringatan) != 0)
                <?php $no = 0; ?>
                @foreach ($suratPeringatan as $p)
                    <?php $no++; ?>
                    <tr>
                        <td colspan="2" valign="center" align="center" @if ($no % 2 == 0) style="background-color: #979797"  
@else 
                                        style="background-color:#e6e6e6 " @endif>
                            {{ $p->tanggal }}
                        </td>
                        <td valign="center" align="center" @if ($p->id % 2 == 0) style="background-color: #e6e6e6"  
@else 
                                                    style="background-color: #979797" @endif>
                            SP-{{ $p->tingkat }}
                        </td>
                        <td colspan="3" valign="center" align="center" @if ($p->id % 2 == 0) style="background-color: #e6e6e6"  
@else 
                                                    style="background-color: #979797" @endif>
                            @foreach ($p->pelanggaran as $item)
                                {{ $item }} ,
                            @endforeach
                        </td>
                    </tr>
                @endforeach

            @else
                <tr>
                    <td colspan="6" align="center" style="background-color: #2aa700">
                        Belum Pernah Dapat Surat Peringatan
                    </td>
                </tr>
            @endif
        </table>
    </table>
</body>

</html>
