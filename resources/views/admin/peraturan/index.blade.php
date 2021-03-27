@extends('layout.base')

@section('title', 'Kebijakan Kantor')



@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-info3 position-left"></i> <span class="text-semibold">Kebijakan Kantor</span>
                    - Kebijakan Jam Kerja & Cuti Pegawai</h4>
            </div>

        </div>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel bg-primary">
                <div class="panel-heading">
                    <h5 class="panel-title">Jam Masuk Kantor</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class=" icon-more2"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="" data-toggle="modal" data-target="#modal_form_jamMasuk"> <i
                                                class=" icon-pencil7"></i> Edit </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="panel-body text-center">
                    <h3> {{ $peraturan->jam_masuk }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel bg-teal">
                <div class="panel-heading">
                    <h5 class="panel-title">Jam Pulang Kantor</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class=" icon-more2"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="" data-toggle="modal" data-target="#modal_form_jamPulang"> <i
                                                class=" icon-pencil7"></i> Edit </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="panel-body text-center">
                    <h3> {{ $peraturan->jam_plg }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="panel bg-warning">
                <div class="panel-heading">
                    <h5 class="panel-title">Batas Cuti Tahunan</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class=" icon-more2"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="" data-toggle="modal" data-target="#modal_form_cutiTahunan"> <i
                                                class=" icon-pencil7"></i> Edit </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

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
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class=" icon-more2"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="" data-toggle="modal" data-target="#modal_form_cutiBersama"> <i
                                                class=" icon-pencil7"></i> Edit </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

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
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class=" icon-more2"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="" data-toggle="modal" data-target="#modal_form_cutiPenting"> <i
                                                class=" icon-pencil7"></i> Edit </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

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
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class=" icon-more2"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="" data-toggle="modal" data-target="#modal_form_cutiSakit"> <i
                                                class=" icon-pencil7"></i> Edit </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

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
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class=" icon-more2"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="" data-toggle="modal" data-target="#modal_form_cutiBesar"> <i
                                                class=" icon-pencil7"></i>
                                            Edit </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

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
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class=" icon-more2"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="" data-toggle="modal" data-target="#modal_form_cutiHamil"> <i
                                                class=" icon-pencil7"></i> Edit </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="panel-body text-center">
                    <h3> {{ $peraturan->jml_cuti_hamil }} Hari</h3>
                </div>
            </div>
        </div>
    </div>




    {{-- MODAL SECTION --}}

    <!-- jamMasuk form modal -->
    <div id="modal_form_jamMasuk" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Edit Jam Masuk</h5>
                </div>
                <?php $id = Crypt::encrypt($peraturan->id); ?>
                <form action="{{ route('peraturan.editJamMasuk', $id) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jam Masuk </label>
                            <input name="jam_masuk" type="time" class="form-control" value="{{ $peraturan->jam_masuk }}">
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



    <!-- jamPulang form modal -->
    <div id="modal_form_jamPulang" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Edit Jam Pulang</h5>
                </div>
                <?php $id = Crypt::encrypt($peraturan->id); ?>
                <form action="{{ route('peraturan.editJamPulang', $id) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jam Pulang </label>
                            <input name="jam_plg" type="time" class="form-control" value="{{ $peraturan->jam_plg }}">
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


    <!-- cutiTahunan form modal -->
    <div id="modal_form_cutiTahunan" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Edit Batas Cuti Tahunan</h5>
                </div>
                <?php $id = Crypt::encrypt($peraturan->id); ?>
                <form action="{{ route('peraturan.editCutiTahunan', $id) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Batas Cuti Tahunan </label>
                            <input name="jml_cuti_tahunan" type="number" class="form-control"
                                value="{{ $peraturan->jml_cuti_tahunan }}">
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


    <!-- cutiBersama form modal -->
    <div id="modal_form_cutiBersama" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Edit Batas Cuti Bersama</h5>
                </div>
                <?php $id = Crypt::encrypt($peraturan->id); ?>
                <form action="{{ route('peraturan.editCutiBersama', $id) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Batas Cuti Bersama </label>
                            <input name="jml_cuti_bersama" type="number" class="form-control"
                                value="{{ $peraturan->jml_cuti_bersama }}">
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


    <!-- cutiPenting form modal -->
    <div id="modal_form_cutiPenting" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Edit Batas Cuti Penting</h5>
                </div>
                <?php $id = Crypt::encrypt($peraturan->id); ?>
                <form action="{{ route('peraturan.editCutiPenting', $id) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Batas Cuti Penting </label>
                            <input name="jml_cuti_penting" type="number" class="form-control"
                                value="{{ $peraturan->jml_cuti_penting }}">
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


    <!-- cutiSakit form modal -->
    <div id="modal_form_cutiSakit" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Edit Batas Cuti Sakit</h5>
                </div>
                <?php $id = Crypt::encrypt($peraturan->id); ?>
                <form action="{{ route('peraturan.editCutiSakit', $id) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Batas Cuti Sakit </label>
                            <input name="jml_cuti_sakit" type="number" class="form-control"
                                value="{{ $peraturan->jml_cuti_sakit }}">
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


    <!-- cutiBesar form modal -->
    <div id="modal_form_cutiBesar" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Edit Batas Cuti Besar</h5>
                </div>
                <?php $id = Crypt::encrypt($peraturan->id); ?>
                <form action="{{ route('peraturan.editCutiBesar', $id) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Batas Cuti Besar </label>
                            <input name="jml_cuti_besar" type="number" class="form-control"
                                value="{{ $peraturan->jml_cuti_besar }}">
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

    <!-- cutiBesar form modal -->
    <div id="modal_form_cutiHamil" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Edit Batas Cuti Hamil</h5>
                </div>
                <?php $id = Crypt::encrypt($peraturan->id); ?>
                <form action="{{ route('peraturan.editCutiHamil', $id) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Batas Cuti Hamil </label>
                            <input name="jml_cuti_hamil" type="number" class="form-control"
                                value="{{ $peraturan->jml_cuti_hamil }}">
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





@endsection
