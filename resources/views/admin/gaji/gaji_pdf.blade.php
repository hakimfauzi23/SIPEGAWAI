<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('/css/bootstrap.css') }}">
    <title>Document</title>
    <style>
        .container {
            /* height: 100%; */
            border-style: solid;
            font-size: 14px;

        }

        .judul-slip {
            text-align: center;
            font-size: 20px;
        }


        hr.hitam {
            border: 1px solid rgb(0, 0, 0);
        }

        hr.hitamJuga {
            border: 1px dashed rgb(0, 0, 0);
        }

        .info-umum {
            display: inline-block;
        }

        table td {
            padding-left: 15px;
            padding-top: 5px;

        }

        .info-pegawai {
            padding-left: 15px;
            display: inline-block;
        }


        .sign {
            padding-right: 30px;
            padding-bottom: 50px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="judul-slip">
            LAPORAN SLIP GAJI PEGAWAI
        </div>
        <hr class="hitam">

        <div class="info">
            <div class="info-umum">
                <table>
                    <tr>
                        <td>Nama Perusahaan</td>
                        <td>:</td>
                        <td>{{ $perusahaan->nama }}</td>
                    </tr>
                    <tr>
                        <td>Periode</td>
                        <td>:</td>
                        <td>{{ date('d/m/Y', strtotime($period_dari)) . ' - ' . date('d/m/Y', strtotime($period_ke)) }}
                        </td>
                    </tr>

                    <tr>
                        <td>Divisi</td>
                        <td>:</td>
                        <td> {{ $pegawai->divisi->nm_divisi }}</td>
                    </tr>
                </table>
            </div>

            <div class="info-pegawai">
                <table>
                    <tr>
                        <td>ID Pegawai</td>
                        <td>:</td>
                        <td>{{ $pegawai->id }}</td>
                    </tr>
                    <tr>
                        <td>Nama Pegawai</td>
                        <td>:</td>
                        <td>{{ $pegawai->nama }}</td>
                    </tr>

                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td> {{ $pegawai->jabatan->nm_jabatan }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <hr class="hitam">

        <div class="info-gaji">
            <div class="table">
                <table class="table">
                    <tr style="background-color: rgb(56, 228, 56);">
                        <td></td>
                        <td class="text-right">PEMASUKAN</td>
                    </tr>
                    <tr>
                        <td>Gaji Pokok</td>
                        <td class="text-right">: @currency($gaji_pokok)</td>
                    </tr>

                    @foreach ($att_tunjangan as $p)
                        @if ($p->is_active != 0)
                            <tr>
                                <td>{{ $p->nama }}</td>
                                <td class="text-right">: @currency($p->jumlah)</td>
                            </tr>
                        @endif
                    @endforeach
                    @if ($tunj_status != 0)
                        <tr>
                            <td>{{ 'Tunjangan Keluarga' }}</td>
                            <td class="text-right">: @currency($tunj_status)</td>
                        </tr>
                    @endif
                    @if ($tunj_anak != 0)
                        <tr>
                            <td>{{ 'Tunjangan Anak' }}</td>
                            <td class="text-right">: @currency($tunj_anak)</td>
                        </tr>
                    @endif
                    @if ($tunj_kinerja != 0)
                        <tr>
                            <td>{{ 'Tunjangan Kinerja' }}</td>
                            <td class="text-right">: @currency($tunj_kinerja)</td>
                        </tr>
                    @endif
                    <tr style="font-weight: bold;">
                        <td>Total Pemasukan(A)</td>
                        <td class="text-right">@currency($tot_pemasukan)</td>
                    </tr>
                </table>
                <table class="table">
                    <tr style="background-color: rgb(209, 19, 19);">
                        <td></td>
                        <td class="text-right">POTONGAN</td>
                    </tr>
                    @if ($jml_ptgn_telat != 0)
                        <tr>
                            <td>Potongan Keterlambatan</td>
                            <td class="text-right">:@currency($jml_ptgn_telat)</td>
                        </tr>
                    @endif
                    @if ($jml_ptgn_bolos != 0)
                        <tr>
                            <td>Potongan Membolos</td>
                            <td class="text-right">: @currency($jml_ptgn_bolos)</td>
                        </tr>
                    @endif
                    @if ($pot_bpjs_kes != 0)
                        <tr>
                            <td>{{ 'Iuran BPJS Kesehatan' }}</td>
                            <td class="text-right">: @currency($pot_bpjs_kes)</td>
                        </tr>
                    @endif
                    @if ($pot_bpjs_ket != 0)
                        <tr>
                            <td>{{ 'Iuran BPJS Ketenagakerjaan (JHT)' }}</td>
                            <td class="text-right">: @currency($pot_bpjs_ket)</td>
                        </tr>
                    @endif
                    @if ($pot_pph != 0)
                        <tr>
                            <td>{{ 'Potongan PPH 21' }}</td>
                            <td class="text-right">: @currency($pot_pph)</td>
                        </tr>
                    @endif
                    @foreach ($att_potongan as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td class="text-right">: @currency($p->jumlah)</td>
                        </tr>
                    @endforeach
                    <tr style="font-weight: bold;">
                        <td>Total Potongan(B)</td>
                        <td class="text-right">@currency($jml_ptgn)</td>
                    </tr>

                </table>
                <table border="0" class="table">
                    <tr style="font-weight: bold;">
                        <td>Total Gaji yang Diterima(A-B)</td>
                        <td class="text-right">@currency($tot_gaji_diterima)</td>
                    </tr>
                </table>
            </div>
            <hr class="hitamJuga">
            <div class="sign text-right">
                Dibuat Oleh,
                <br>
                {{ Auth::user()->jabatan->nm_jabatan }}
                <br>
                <div class="mt-3"></div>
                {{ Auth::user()->nama }}
            </div>
        </div>
    </div>
</body>

</html>
