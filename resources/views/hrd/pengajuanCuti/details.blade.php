@extends('layout.base')

@section('title', 'Details Pengajuan Cuti')

@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-furniture"></i> <span class="text-semibold">Data Cuti</span>
                    - Details Pengajuan Cuti</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('hrdPengajuanCuti.index') }}"> <i class="active icon-home2 position-left"></i> List
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
                        yang terdaftar.
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
                        <tr>
                            <td>Disetujui Atasan</td>
                            <td>:</td>
                            @if ($cuti->pegawai->id_atasan == null)
                                <td> - </td>
                            @else
                                <td>{{ $cuti->tgl_disetujui_atasan }}</td>
                            @endif

                        </tr>

                    </table>
                </div>
            </div>
        </div>


        <div class="text-center">


            <form action="{{ route('hrdPengajuanCuti.keputusan', $id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <input type="text" name="tgl_mulai" value="{{ $cuti->tgl_mulai }}" hidden>
                <input type="text" name="tgl_selesai" value="{{ $cuti->tgl_selesai }}" hidden>
                <input type="text" name="id_pegawai" value="{{ $cuti->id_pegawai }}" hidden>
                <button class="btn btn-success" name="keputusan" type="submit" value="Disetujui HRD"> Setujui</button>
                <button class="btn btn-danger" name="keputusan" type="submit" value="Ditolak HRD"> Tolak</button>
            </form>
        </div>

    </div>
@endsection
