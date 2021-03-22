<div class="admin" hidden>
    <ul class="navigation navigation-main navigation-accordion">


        <!-- Main -->
        <li class="navigation-header"><span>Menu Super Admin</span> <i class="icon-menu"></i></li>
        <li class="{{ Request::segment(1) === 'peraturan' ? 'active' : null }}"><a
                href="{{ route('peraturan.index') }}"><i class=" icon-info3"></i> <span>Kebijakan Cuti & Jam
                    Kantor</span></a></li>
        <li class="{{ Request::segment(1) === 'pegawai' ? 'active' : null }}"><a
                href="{{ route('pegawai.index') }}"><i class="icon-users" title="Data Pegawai"></i><span>Data
                    Pegawai</span></a></li>
        <li>
            <a href="#"><i class="icon-user-tie"></i> <span>Data Jabatan</span></a>
            <ul>
                <li class="{{ Request::segment(1) === 'jabatan' ? 'active' : null }}"><a
                        href="{{ route('jabatan.index') }}">List Data Jabatan</a>
                </li>
                <li class="{{ Request::segment(1) === 'riwayatJabatan' ? 'active' : null }}"><a
                        href="{{ route('riwayatJabatan.index') }}">Data Riwayat Jabatan</a></li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="icon-hat"></i> <span>Data Divisi</span></a>
            <ul>
                <li class="{{ Request::segment(1) === 'divisi' ? 'active' : null }}"><a
                        href="{{ route('divisi.index') }}">List Data Divisi</a>
                </li>
                <li class="{{ Request::segment(1) === 'riwayatDivisi' ? 'active' : null }}"><a
                        href="{{ route('riwayatDivisi.index') }}">Data Riwayat Divisi</a></li>
            </ul>
        </li>

        {{-- <li><a href="{{ route('presensi.index') }}"><i class="icon-notebook"></i> <span>Data Presensi</span></a></li> --}}

        <li>
            <a href="#"><i class="icon-notebook"></i> <span>Data Presensi</span></a>
            <ul>
                <li class="{{ Request::segment(1) === 'presensi' ? 'active' : null }}"><a
                        href="{{ route('presensi.index') }}">List Data Presensi</a>
                </li>
                <li class="{{ Request::segment(1) === 'rekapPresensi' ? 'active' : null }}"><a
                        href="{{ route('rekapPresensi.index') }}">Rekapan Data Presensi Pegawai</a></li>
            </ul>
        </li>

        <li>
            <a href="#"><i class="icon-furniture"></i> <span>Data Cuti</span></a>
            <ul>
                <li class="{{ Route::is('cuti.index') ? 'active' : null }}"><a
                        href="{{ route('cuti.index') }}">List Data Cuti</a>
                </li>
                <li class="{{ Route::is('cuti.cutiBersama') ? 'active' : null }}"><a
                        href="{{ route('cuti.cutiBersama') }}">Atur Tanggal Cuti Bersama</a></li>
                <li class="{{ Request::segment(1) === 'rekapCuti' ? 'active' : null }}"><a
                        href="{{ route('rekapCuti.index') }}">Rekapan Data Cuti Pegawai</a></li>
            </ul>
        </li>
        <!-- /main -->

    </ul>
</div>



<div class="hrd">
    <ul class="navigation navigation-main navigation-accordion">
        <!-- hrd -->
        <li class="navigation-header"><span>Menu HRD</span> <i class="icon-menu"></i></li>
        <li class="{{ Request::segment(1) === 'hrdPeraturan' ? 'active' : null }}"><a
                href="{{ route('hrdPeraturan.index') }}"><i class=" icon-info3"></i> <span>Kebijakan Cuti & Jam
                    Kantor</span></a></li>
        <li class="{{ Request::segment(1) === 'hrdPegawai' ? 'active' : null }}"><a
                href="{{ route('hrdPegawai.index') }}"><i class="icon-users" title="Data Pegawai"></i><span>Data
                    Pegawai</span></a></li>

        <li>
            <a href="#"><i class="icon-notebook"></i> <span>Data Presensi</span></a>
            <ul>
                <li class="{{ Request::segment(1) === 'hrdPresensiHarian' ? 'active' : null }}"><a
                        href="{{ route('hrdPresensiHarian.index') }}">List Data Presensi</a>
                </li>
                <li class="{{ Request::segment(1) === 'rekapPresensi' ? 'active' : null }}"><a
                        href="{{ route('rekapPresensi.index') }}">Rekapan Data Presensi Pegawai</a></li>
            </ul>
        </li>

        <li>
            <a href="#"><i class="icon-furniture"></i> <span>Data Cuti</span><span
                    class="badge bg-warning-400">{{ $jml_cuti }}</span></a>
            <ul>
                <li class="<?php if (Route::is('hrdCuti.index') || Route::is('hrdCuti.search')) {
                    echo 'active';
                } ?>"><a href="{{ route('hrdCuti.index') }}">List Data Cuti</a>
                </li>
                <li class="{{ Route::is('hrdCuti.cutiBersama') ? 'active' : null }}"><a
                        href="{{ route('hrdCuti.cutiBersama') }}">Atur Tanggal Cuti Bersama</a></li>
                <li class="{{ Request::segment(1) === 'hrdPengajuanCuti' ? 'active' : null }}"><a
                        href="{{ route('hrdPengajuanCuti.index') }}"> <span
                            class="badge bg-warning-400">{{ $jml_cuti }}</span>
                        Pengajuan Cuti Pegawai</a>
                </li>
                <li class="{{ Request::segment(1) === 'rekapCuti' ? 'active' : null }}"><a
                        href="{{ route('rekapCuti.index') }}">Rekapan Data Cuti Pegawai</a></li>
            </ul>
        </li>
        <!-- /hrd -->

    </ul>
</div>
