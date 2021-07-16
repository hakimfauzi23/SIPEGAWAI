@extends('layout.base')

@section('title', 'Details Pengajuan Cuti')

@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-furniture"></i> <span class="text-semibold">Cuti</span>
                    - Details Pengajuan Cuti</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('staffPengajuanCuti.index') }}"> <i class="active icon-home2 position-left"></i>
                        List
                        Pengajuan Cuti Pegawai
                    </a>
                </li>
                <li class="active">Details Pengajuan Cuti ID : {{ $cuti->id }} </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-md-12">

        <div class="panel bg-info">
            <div class="panel-heading">
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
                <em>
                    <h6> Halaman ini menampilakan details data cuti, dan data pemohon cuti, setelah cuti Disetujui/Ditolak
                        sistem akan mengirimkan notifikasi berupa email ke alamat email pegawai
                        yang terdaftar dan mengirimkan email pemberitahuan juga ke <b> HRD </b> perusahaan.
                    </h6>
                </em>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="panel ">
            <div class="panel-heading bg-info">
                <h5 class="panel-title text-center">Data Pemohon</h5>
            </div>

            <div class="panel-body">
                <div class="text-center">
                    @php $path =Storage::url('images/'.$cuti->pegawai->path); @endphp
                    <img src="{{ url($path) }}"
                        onerror="this.onerror=null; this.src='{{ URL::to('/admin/assets/images/brands/user.jpeg') }}'"
                        alt="Foto Profil" width="160">
                </div>
                <div class="mb-3"></div>
                <div class="table-responsive">
                    <table class="table table-xs">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $cuti->pegawai->nama }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ $cuti->pegawai->email }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>{{ $cuti->pegawai->jabatan->nm_jabatan }}</td>
                        </tr>
                        <tr>
                            <td>Divisi</td>
                            <td>:</td>
                            <td>{{ $cuti->pegawai->divisi->nm_divisi }}</td>
                        </tr>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="panel">
            <div class="panel-heading bg-info">
                <h5 class="panel-title text-center">Data Cuti</h5>

            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td><a href="" data-toggle="modal" data-target="#modal_iconified">
                                    <i class="icon-info22"></i> Lihat riwayat cuti pegawai</a></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Tipe Cuti</td>
                            <td>:</td>
                            <td>{{ $cuti->tipe_cuti }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengajuan</td>
                            <td>:</td>
                            <td>{{ $cuti->tgl_pengajuan }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai Cuti</td>
                            <td>:</td>
                            <td>{{ $cuti->tgl_mulai }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai Cuti</td>
                            <td>:</td>
                            <td>{{ $cuti->tgl_selesai }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ $cuti->ket }}</td>
                        </tr>
                        <tr>
                            <td>Atasan/Penanggung Jawab</td>
                            <td>:</td>
                            @if ($cuti->pegawai->id_atasan == null)
                                <td> Belum Ada Atasan </td>
                            @else
                                <td>{{ $cuti->pegawai->bawahan->nama }}</td>
                            @endif
                        </tr>

                    </table>
                </div>
            </div>
        </div>


        <div class="text-center">
            <form action="{{ route('staffPengajuanCuti.keputusan', $id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <input type="text" name="tgl_mulai" value="{{ $cuti->tgl_mulai }}" hidden>
                <input type="text" name="tgl_selesai" value="{{ $cuti->tgl_selesai }}" hidden>
                <input type="text" name="id_pegawai" value="{{ $cuti->id_pegawai }}" hidden>
                <button class="btn btn-success" name="keputusan" type="submit" value="Disetujui Atasan"> Setujui</button>
                <button class="btn btn-danger" name="keputusan" type="submit" value="Ditolak Atasan"> Tolak</button>
            </form>
        </div>
    </div>

    <!-- Iconified modal -->
    <div id="modal_iconified" class="modal fade">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-info3"></i> &nbsp;Riwayat Data Cuti Pegawai Tahun Ini
                    </h5>
                </div>
                <div class="modal-body" id="list_item">
                    <div class="row">
                        <div class="col">
                            <legend class="text-bold"></i> A. Riwayat Cuti Terakhir
                            </legend>
                        </div>
                        <table id="classTable" class="table ">
                            <thead>
                                <tr>
                                    <th> No</th>
                                    <th> Tanggal Mulai</th>
                                    <th> Tanggal Selesai</th>
                                    <th> Tipe Cuti </th>
                                    <th> Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @if ($riwayatCuti->count())
                                    @foreach ($riwayatCuti as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->tgl_mulai }}</td>
                                            <td>{{ $item->tgl_selesai }}</td>
                                            <td>{{ $item->tipe_cuti }}</td>
                                            <td>{{ $item->ket }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Belum ada data</td>
                                        <td></td>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3"></div>
                    <div class="row">
                        <div class="col">
                            <legend class="text-bold"></i> B. Detail Cuti Terpakai
                            </legend>
                        </div>
                        <table id="classTable" class="table ">
                            <thead>
                                <tr>
                                    <th> Tahunan</th>
                                    <th> Bersama</th>
                                    <th> Penting</th>
                                    <th> Besar </th>
                                    <th> Sakit</th>
                                    <th> Hamil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <tr>
                                    <td>{{ $cutiTahunan . ' / ' . $batasTahunan }}</td>
                                    <td>{{ $cutiBersama . ' / ' . $batasBersama }}</td>
                                    <td>{{ $cutiPenting . ' / ' . $batasPenting }}</td>
                                    <td>{{ $cutiBesar . ' / ' . $batasBesar }}</td>
                                    <td>{{ $cutiSakit . ' / ' . $batasSakit }}</td>
                                    <td>{{ $cutiHamil . ' / ' . $batasHamil }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- /iconified modal -->
@endsection
