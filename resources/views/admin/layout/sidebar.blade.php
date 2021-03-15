<ul class="navigation navigation-main navigation-accordion">

    <!-- Main -->
    <li class="navigation-header"><span>Menu Super Admin</span> <i class="icon-menu"></i></li>
    <li><a href="{{ route('pegawai.index') }}"><i class="icon-users" title="Data Pegawai"></i><span>Data
                Pegawai</span></a></li>
    <li>
        <a href="#"><i class="icon-user-tie"></i> <span>Data Jabatan</span></a>
        <ul>
            <li><a href="{{ route('jabatan.index') }}">List Data Jabatan</a>
            </li>
            <li><a href="{{ route('riwayatJabatan.index') }}">Data Riwayat Jabatan</a></li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="icon-hat"></i> <span>Data Divisi</span></a>
        <ul>
            <li><a href="{{ route('divisi.index') }}">List Data Divisi</a>
            </li>
            <li><a href="{{ route('riwayatDivisi.index') }}">Data Riwayat Divisi</a></li>
        </ul>
    </li>

    <li><a href="{{ route('presensi.index') }}"><i class="icon-notebook"></i> <span>Data Presensi</span></a></li>
    <li>
        <a href="#"><i class="icon-furniture"></i> <span>Data Cuti</span></a>
        <ul>
            <li><a href="{{ route('cuti.index') }}">List Data Cuti</a>
            </li>
            <li><a href="{{ route('cuti.cutiBersama') }}">Atur Tanggal Cuti Bersama</a></li>
        </ul>
    </li>
    <!-- /main -->

</ul>
