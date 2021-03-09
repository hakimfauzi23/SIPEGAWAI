@extends('user.layouts.base')

@section('title', 'Data Pegawai')

@section('content')


    <!-- Start top-section Area -->
    <section class="banner-area relative">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-between align-items-center text-center banner-content">
                <div class="col-lg-12">
                    <h1 class="text-white">Pengajuan Cuti Pegawai</h1>
                    <p>Memempermudah HRD untuk mengetahui pengajuan cuti yang belum disetujui atau baru dibuat. </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End top-section Area -->




    <section class="about-area section-gap">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('hrdCuti.pengajuan') }}">Data Pengajuan Cuti</a></li>
                    <li class="breadcrumb-item"> {{ 'ID:' . $cuti->id . '-' . $cuti->pegawai->nama }} </li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card border-left-primary shadow">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                @php $path =Storage::url('images/'.$cuti->pegawai->path); @endphp
                                <img src="{{ url($path) }}" alt="Foto Profil" width="150">
                                <div class="mt-3">
                                    <p class="h3 mb-1">{{ $cuti->pegawai->jabatan->nm_jabatan }}</p>
                                    <p class="text-muted h5 ">Divisi {{ $cuti->pegawai->divisi->nm_divisi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-left-success shadow mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"> ID Pegawai </h6>
                                <span class="text-secondary">{{ $cuti->pegawai->id }}</span>
                            </li>
                        </ul>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"> Nama Pegawai </h6>
                                <span class="text-secondary">{{ $cuti->pegawai->nama }}</span>
                            </li>
                        </ul>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"> Email </h6>
                                <span class="text-secondary">{{ $cuti->pegawai->email }}</span>
                            </li>
                        </ul>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"> Nomor Handphone </h6>
                                <span class="text-secondary">{{ $cuti->pegawai->no_hp }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card border-left-warning shadow mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"> Lama Kerja </h6>
                                <span
                                    class="text-secondary">{{ $interval->y . ' Tahun, ' . $interval->m . ' Bulan, ' . $interval->d . ' Hari ' }}</span>
                            </li>
                        </ul>
                    </div>


                </div>

                <div class="col-md-8">
                    <div class="card border-left-warning shadow mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Tipe Cuti </h6>
                                </div>
                                <div class="col-sm-6 text-secondary text-right">
                                    {{ $cuti->tipe_cuti }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Tanggal Pengajuan</h6>
                                </div>
                                <div class="col-sm-6 text-secondary text-right">
                                    {{ $cuti->tgl_pengajuan }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Tanggal Mulai</h6>
                                </div>
                                <div class="col-sm-6 text-secondary text-right">
                                    {{ $cuti->tgl_mulai }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Tanggal Selesai</h6>
                                </div>
                                <div class="col-sm-6 text-secondary text-right">
                                    {{ $cuti->tgl_selesai }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Keterangan</h6>
                                </div>
                                <div class="col-sm-6 text-secondary text-right">
                                    {{ $cuti->ket }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Status</h6>
                                </div>
                                <div class="col-sm-6 text-secondary text-right">
                                    {{ $cuti->status }}
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card mt-5 align-items-center text-center border-0 bg-transparent">
                        <?php $encyrpt = Crypt::encryptString($cuti->id); ?>

                        <div class="sm-6">
                            <form method="post" action="{{ route('hrdCuti.keputusan', $encyrpt) }}">

                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <button class="btn btn-success approve-confirm" name="status" type="submit"
                                    value="Disetujui">Setujui Pengajuan</button>
                                <button class="btn btn-danger" name="status" type="submit" value="Ditolak">Tolak
                                    Pengajuan</button>
                            </form>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
