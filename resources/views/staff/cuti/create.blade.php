@extends('layout.base')


@section('title', 'Pengajuan Cuti')


@section('script_tanggal')
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/notifications/jgrowl.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/pickers/anytime.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/pickers/pickadate/picker.date.js">
    </script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/pickers/pickadate/picker.time.js">
    </script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/pickers/pickadate/legacy.js"></script>

@endsection


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user"></i> <span class="text-semibold">Menu Staff</span>
                    - Buat Pengajuan Cuti</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <i class="active icon-home2 position-left"></i> Buat Pengajuan
                    Cuti
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Di halaman ini anda dapat mengajukan cuti seperti cuti besar, cuti tahunan, dan lainya. Setelah berhasil
                    mengajukan cuti sistem akan mengirimkan pemberitahuan ke atasan (langsung HRD apabila tidak ada atasan)
                    berupa email ke masing-masing alamat email atasan pegawai.
                    <br> <b>Apabila pilihan tidak bisa dipilih itu berarti anda belum memenuhi persyaratan untuk mengambil
                        cuti
                        tersebut.</b>
                </h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Buat Pengajuan Cuti</h5>
        </div>

        <div class="panel-body">

            <div class="row">
                <form action="{{ route('staffCuti.store') }}" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}


                    <div class="form-group">
                        <label for="inputState">Tipe Cuti</label>
                        <select class=" select" name="tipe_cuti" data-placeholder="Pilih Tipe Cuti">
                            <option value="">Pilih Tipe Cuti</option>
                            <option value="Tahunan" @if ($months < $syarat_bulan_cuti_tahunan || $sisaTahunan <= 0) {{ 'disabled' }} @endif> Tahunan </option>
                            <option value="Besar" @if ($months < $syarat_bulan_cuti_besar || $sisaBesar <= 0) {{ 'disabled' }} @endif> Besar </option>
                            <option value="Hamil" @if (Auth::user()->jk != 'Wanita' || $sisaHamil <= 0) {{ 'disabled' }} @endif> Hamil </option>
                            <option value="Sakit" @if ($sisaSakit <= 0) {{ 'disabled' }} @endif>Sakit </option>
                            <option value="Penting" @if ($sisaPenting <= 0) {{ 'disabled' }} @endif> Penting </option>
                        </select>
                        @if ($errors->has('tipe_cuti'))
                            <div class="text-danger">
                                {{ $errors->first('tipe_cuti') }}
                            </div>
                        @endif
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" class="form-control " min="{{ date('Y-m-d') }}"
                                    value="{{ old('tanggal') }}">
                                @if ($errors->has('tgl_mulai'))
                                    <div class="text-danger">
                                        {{ $errors->first('tgl_mulai') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="tgl_selesai" class="form-control" min="{{ date('Y-m-d') }}"
                                    value="{{ old('tanggal') }}">
                                @if ($errors->has('tgl_selesai'))
                                    <div class="text-danger">
                                        {{ $errors->first('tgl_selesai') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="inputAddress">Keterangan</label>
                        <textarea name="ket" class="form-control" cols="30" rows="5"
                            placeholder="Contoh : Mengantarkan Anak Khitanan/Baptis , Menikah , Menikahkan Anak, dan lain-lain . . ">{{ old('ket') }}</textarea>

                        @if ($errors->has('ket'))
                            <div class="text-danger">
                                {{ $errors->first('ket') }}
                            </div>
                        @endif

                    </div>

                    <div class="">
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">Submit form <i
                                    class="icon-arrow-right14 position-right"></i></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
