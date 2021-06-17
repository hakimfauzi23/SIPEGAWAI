<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('/css/bootstrap.css') }}">
    <title>Surat Peringatan III</title>
    <style>
        * {
            color: black;

        }

        .container {
            /* height: 100%; */
            font-size: 14px;
            font-family: "Times New Roman", Times, serif;

        }

        p {
            font-size: 16px;
            color: black;
        }

        table {
            font-size: 16px;
            color: black;
        }


        ol {
            font-size: 16px;
            line-height: 1.8;
        }

        li {
            font-size: 16px;
            line-height: 1.8;
        }

        .logo-perusahaan img {
            height: 60px;
            width: 130px;
            display: flex;
        }

        .info-perusahaan {
            text-align: center;
            display: inline-block;
            padding-left: 20px;

        }

        .info-surat {
            text-align: center;
            font-size: 20px;
        }

        .info-pegawai {
            padding-top: 30px;
            padding-left: 25px;
            padding-right: 25px;
        }

        .isi-surat {
            padding-top: 35px;
            padding-left: 25px;
            padding-right: 25px;
            text-align: justify;
        }

        .isi-surat p {
            line-height: 1.8;
        }

        .pemberitahuan {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        hr.hitam {
            border: 1px solid rgb(0, 0, 0);
        }

        .sign {
            padding-right: 30px;
            padding-bottom: 50px;
            padding-top: 35px;
        }

        /* Create two unequal columns that floats next to each other */
        .column {
            float: left;
        }

        .left {
            width: 25%;
        }

        .right {
            width: 75%;
            text-align: center;
        }

        .column img {
            display: block;
            max-width: 150px;
            min-height: 50px;
            max-height: 120px;
            width: auto;
            height: auto;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="column left">
                <?php $path = Storage::url('images/' . $perusahaan->path_logo); ?>
                <img src="{{ public_path() . $path }}">
            </div>
            <div class="column right">
                <h4>{{ $perusahaan->nama }}</h4>
                <h5>{{ $perusahaan->alamat }}</h5>
                <h6>Email: {{ $perusahaan->email_public }}, No. Telp:{{ $perusahaan->no_telp }}</h6>
            </div>
        </div>
        <hr class="hitam">
        <div class="info-surat">
            <h4>SURAT PERINGATAN</h4>
            <h5>Nomor : {{ $id_surat }}/HRD/SP-III/{{ $bulan }}/{{ $tahun }}</h5>
        </div>

        <div class="info-pegawai">
            <p>Surat ini Ditujukan Kepada : </p>
            <table style="padding-left: 15px">
                <tr>
                    <td>ID Pegawai</td>
                    <td style="padding-left:15px;padding-right:15px">:</td>
                    <td>{{ $pegawai->id }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td style="padding-left:15px;padding-right:15px">:</td>
                    <td>{{ $pegawai->nama }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td style="padding-left:15px;padding-right:15px">:</td>
                    <td>{{ $pegawai->jabatan->nm_jabatan }}</td>
                </tr>
                <tr>
                    <td>Divisi</td>
                    <td style="padding-left:15px;padding-right:15px">:</td>
                    <td>{{ $pegawai->divisi->nm_divisi }}</td>
                </tr>
            </table>
        </div>
        <div class="isi-surat">
            <div class="pembuka">
                <p>
                    Bersama dengan surat ini kami, Refactory Yogyakarta menyampaikan Surat Peringatan III terkait
                    perihal Surat Peringatan I dan Surat Peringatan II</p>
            </div>
            <div class="pemberitahuan">
                <p>
                    Surat ini merupakan Surat Pemutusan Hubungan Kerja (PHK) Perusahaan, pengambilan keputusan oleh Kami
                    Selaku HRD sudah final dan tidak bisa diganggu gugat.
                </p>
                <p>
                    Kesan kami terhadap @if ($pegawai->jk != 'Wanita')
                        {{ 'Saudara ' . $pegawai->nama }}@else{{ 'Saudari' . $pegawai->nama }}@endif . Anda seorang Pegawai yang baik selama bekerja di Refactory Yogyakarta, dalam hal
                    ini kami ingin memberikan contoh yang nyata bagi semua Pegawai Refactory supaya dapat mengemban
                    tanggung jawab dan menerapkan kedisiplinan dengan lebih baik lagi.
                </p>
            </div>

            <div class="penutup">
                <p>
                    Demikian Surat Peringatan III ini dan pemberhentian hubungan kerja ini. Kami dari pihak Refactory
                    mengucapkan terima kasih sudah bergabung dengan kami Selama Ini.
                </p>
            </div>
        </div>

        <div class="sign text-right">

            <div class="tanggal" style="padding-bottom: 20px">
                {{ $perusahaan->kota . ', ' . date('d F Y', strtotime($tanggal)) }}
            </div>
            <br>
            {{ Auth::user()->jabatan->nm_jabatan }}
            <br>
            <div class="mt-3"></div>
            {{ Auth::user()->nama }}
        </div>

    </div>
</body>

</html>
