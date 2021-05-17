@extends('layout.base')

@section('title', 'Details Data Cuti')

@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-key"></i> <span class="text-semibold">Manajemen Role dan Menu</span>
                    - Details Data Role</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('manajemen.index') }}"> <i class="active icon-home2 position-left"></i> Manajemen Role dan Menu
                    </a>
                </li>
                <li class="active">Details Data Role ID : {{ $role->id }} </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading bg-teal">
                <h5 class="panel-title">Detail Hak Akses Role</h5>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-xs">
                        <tr>
                            <td>Nama Role</td>
                            <td>:</td>
                            <td>{{ $role->name }}</td>
                        </tr>
                        <tr>
                            <td>Hak Akses</td>
                            <td>:</td>
                            <td>
                                @if (!$rolePermissions->isEmpty())
                                    @foreach ($rolePermissions as $v)
                                        <label class="label label-success">{{ $v->name }}</label>
                                    @endforeach
                                @else
                                Belum punya Akses
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
