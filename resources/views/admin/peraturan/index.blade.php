@extends('layout.base')

@section('title', 'Kebijakan Kantor')



@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-info3 position-left"></i> <span class="text-semibold">Kebijakan Cuti & Jam Kantor</span>
            </div>

        </div>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel bg-info">
                <div class="panel-heading">
                    <em>
                        <h6>Halaman ini berfungsi untuk mengubah/mengupdate peraturan kantor seperti jam masuk & jam pulang
                            kantor, syarat cuti tahunan, batas cuti.</h6>
                    </em>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h5 class="panel-title">List Peraturan </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class=" icon-more2"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="" data-toggle="modal" data-target="#modal_form_edit_peraturan"> <i
                                                class=" icon-pencil7"></i> Edit </a>
                                        <a href="" data-toggle="modal" data-target="#modal_riwayat"> <i
                                                class=" icon-history"></i> Riwayat Update </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel bg-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Jam Masuk Kantor</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <h3> {{ date('H:i', strtotime($peraturan->jam_masuk)) }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel bg-teal">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Jam Pulang Kantor</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <h3> {{ date('H:i', strtotime($peraturan->jam_plg)) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="panel bg-warning">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Batas Cuti Tahunan</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <h3> {{ $peraturan->jml_cuti_tahunan }} Hari</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="panel bg-danger">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Batas Cuti Bersama</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <h3> {{ $peraturan->jml_cuti_bersama }} Hari</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="panel bg-info">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Batas Cuti Penting</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <h3> {{ $peraturan->jml_cuti_penting }} Hari</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="panel bg-orange-400">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Batas Cuti &nbsp; Sakit</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <h3> {{ $peraturan->jml_cuti_sakit }} Hari</h3>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="panel bg-success">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Batas Cuti Besar</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <h3> {{ $peraturan->jml_cuti_besar }} Hari</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="panel bg-indigo">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Batas Cuti Hamil</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <h3> {{ $peraturan->jml_cuti_hamil }} Hari</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel bg-warning">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Syarat Lama Kerja Untuk Cuti Tahunan</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <h3> {{ $peraturan->syarat_bulan_cuti_tahunan }}
                                        Bulan </h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel bg-success">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Syarat Lama Kerja Untuk Cuti Besar</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <h3> {{ $peraturan->syarat_bulan_cuti_besar }}
                                        Bulan </h3>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- MODAL SECTION --}}
    <!-- form modal -->
    <div id="modal_form_edit_peraturan" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Peraturan & Kebijakan Kantor</h4>
                </div>
                <form action="{{ route('peraturan.store') }}" method="POST">

                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Jam Masuk Kantor </label>
                                </div>
                                <div class="col-md-8">
                                    <input name="jam_masuk" type="time" class="form-control"
                                        value="{{ $peraturan->jam_masuk }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Jam Pulang Kantor </label>
                                </div>
                                <div class="col-md-8">
                                    <input name="jam_plg" type="time" class="form-control"
                                        value="{{ $peraturan->jam_plg }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Batas Cuti Tahunan </label>
                                </div>
                                <div class="col-md-8">
                                    <input name="jml_cuti_tahunan" type="number" class="form-control"
                                        value="{{ $peraturan->jml_cuti_tahunan }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Batas Cuti Bersama </label>
                                </div>
                                <div class="col-md-8">
                                    <input name="jml_cuti_bersama" type="number" class="form-control"
                                        value="{{ $peraturan->jml_cuti_bersama }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Batas Cuti Penting </label>
                                </div>
                                <div class="col-md-8">
                                    <input name="jml_cuti_penting" type="number" class="form-control"
                                        value="{{ $peraturan->jml_cuti_penting }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Batas Cuti Sakit </label>
                                </div>
                                <div class="col-md-8">
                                    <input name="jml_cuti_sakit" type="number" class="form-control"
                                        value="{{ $peraturan->jml_cuti_sakit }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Batas Cuti Besar </label>
                                </div>
                                <div class="col-md-8">
                                    <input name="jml_cuti_besar" type="number" class="form-control"
                                        value="{{ $peraturan->jml_cuti_besar }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Batas Cuti Hamil </label>
                                </div>
                                <div class="col-md-8">
                                    <input name="jml_cuti_hamil" type="number" class="form-control"
                                        value="{{ $peraturan->jml_cuti_hamil }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Syarat Lama Kerja Cuti Tahunan </label>
                                </div>
                                <div class="col-md-8">
                                    <input name="syarat_bulan_cuti_tahunan" type="number" class="form-control"
                                        value="{{ $peraturan->syarat_bulan_cuti_tahunan }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Syarat Lama Kerja Cuti Besar </label>
                                </div>
                                <div class="col-md-8">
                                    <input name="syarat_bulan_cuti_besar" type="number" class="form-control"
                                        value="{{ $peraturan->syarat_bulan_cuti_besar }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /vertical form modal -->


    <div id="modal_riwayat" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="classInfo"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                    <h4 class="modal-title" id="classModalLabel">
                        Riwayat Peraturan
                    </h4>
                </div>
                <div class="modal-body text-center">
                    <table id="classTable" class="table table-bordered">
                        <thead>
                            <tr class="bg-primary">
                                <th>No</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Cuti Tahunan</th>
                                <th>Cuti Bersama</th>
                                <th>Cuti Penting</th>
                                <th>Cuti Sakit</th>
                                <th>Cuti Besar</th>
                                <th>Cuti Hamil</th>
                                <th>Syarat Cuti Tahunan</th>
                                <th>Syarat Cuti Besar</th>
                                <th>Tanggal Berlaku</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @if ($all->count())
                                @foreach ($all as $key => $p)
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td> {{ date('H:i', strtotime($p->jam_masuk)) }} </td>
                                        <td> {{ date('H:i', strtotime($p->jam_plg)) }} </td>
                                        <td> {{ $p->jml_cuti_tahunan }} Hari </td>
                                        <td> {{ $p->jml_cuti_bersama }} Hari</td>
                                        <td> {{ $p->jml_cuti_penting }} Hari</td>
                                        <td> {{ $p->jml_cuti_sakit }} Hari</td>
                                        <td> {{ $p->jml_cuti_besar }} Hari</td>
                                        <td> {{ $p->jml_cuti_hamil }} Hari</td>
                                        <td> {{ $p->syarat_bulan_cuti_tahunan }} Bln</td>
                                        <td> {{ $p->syarat_bulan_cuti_besar }} Bln</td>
                                        <td> {{ date('M-Y', strtotime($p->created_at)) }} </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
