<?php $user = Auth::user(); ?>


<ul class="navigation navigation-main navigation-accordion">
    <li class="navigation-header"><span>Main Menu</span> <i class="icon-menu"></i></li>

    @foreach (App\Models\Menu::orderBy('order', 'asc')->get() as $menuItem)

        @if ($menuItem->id_parent == null)
            @if ($menuItem->url != null)
                @can($menuItem->hak_akses->name)
                    <li class="{{ Request::is($menuItem->url) ? 'active' : null }}"><a
                            href="{{ '/' . $menuItem->url }}"><i class="{{ $menuItem->icon }}"></i>
                            <span>{{ $menuItem->judul }}</span>
                        </a>
                    </li>
                @endcan
            @else
                @can($menuItem->hak_akses->name)
                    @if (strpos($menuItem->judul, 'Cuti') !== false)
                        <li>
                            <a href="#"><i class="{{ $menuItem->icon }}"></i> <span>{{ $menuItem->judul }}
                                </span>
                                @if ($jml_cuti_hrd != 0 && Auth::user()->role->name == 'HRD')
                                    <span class="badge bg-warning-400">{{ $jml_cuti_hrd }}</span>
                                @endif

                            </a>
                            <ul>
                                @foreach ($menuItem->children as $subMenuItem)
                                    @if ($subMenuItem->url == 'hrdPengajuanCuti')
                                        @if (Auth::user()->role->name == 'HRD')
                                            <li class="{{ Request::is($subMenuItem->url) ? 'active' : null }}">
                                                <a href="{{ '/' . $subMenuItem->url }}"> <span
                                                        class="badge bg-warning-400">{{ $jml_cuti_hrd }}</span>
                                                    {{ $subMenuItem->judul }}</a>
                                            </li>
                                        @endif
                                    @elseif ($subMenuItem->url != null)
                                        @can($subMenuItem->hak_akses->name)
                                            <li class="{{ Request::is($subMenuItem->url) ? 'active' : null }}"><a
                                                    href="{{ '/' . $subMenuItem->url }}">
                                                    {{ $subMenuItem->judul }}
                                                </a>
                                            </li>
                                        @endcan
                                    @else
                                        <li>
                                            <a href="#"><span>{{ $subMenuItem->judul }}</span></a>
                                            <ul>
                                                @foreach ($subMenuItem->children as $thirdMenuItem)
                                                    @if ($thirdMenuItem->url == 'staffPengajuanCuti')
                                                        @if ($jml_bawahan != 0)

                                                            <li
                                                                class="{{ Request::is($thirdMenuItem->url) ? 'active' : null }}">
                                                                <a href="{{ '/' . $thirdMenuItem->url }}"> <span
                                                                        class="badge bg-warning-400">{{ $jml_pengajuan_cuti_bawahan }}</span>
                                                                    {{ $thirdMenuItem->judul }}</a>
                                                            </li>
                                                        @endif
                                                    @else
                                                        <li
                                                            class="{{ Request::is($thirdMenuItem->url) ? 'active' : null }}">
                                                            <a href="{{ '/' . $thirdMenuItem->url }}">
                                                                {{ $thirdMenuItem->judul }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>

                        </li>

                    @elseif (strpos($menuItem->judul, 'Staff') !== false)
                        <li>
                            <a href="#"><i class="{{ $menuItem->icon }}"></i> <span>{{ $menuItem->judul }}
                                </span>
                                @if ($jml_pengajuan_cuti_bawahan != 0)
                                    <span class="badge bg-warning-400">{{ $jml_pengajuan_cuti_bawahan }}</span>
                                @endif

                            </a>
                            <ul>
                                @foreach ($menuItem->children as $subMenuItem)

                                    @if ($subMenuItem->url == 'staffPengajuanCuti')
                                        @if ($jml_bawahan != 0)

                                            <li class="{{ Request::is($subMenuItem->url) ? 'active' : null }}">
                                                <a href="{{ '/' . $subMenuItem->url }}"> <span
                                                        class="badge bg-warning-400">{{ $jml_pengajuan_cuti_bawahan }}</span>
                                                    {{ $subMenuItem->judul }}</a>
                                            </li>
                                        @endif
                                    @elseif ($subMenuItem->url == 'hrdPengajuanCuti' && Auth::user()->role == 'HRD')
                                        <li class="{{ Request::is($subMenuItem->url) ? 'active' : null }}">
                                            <a href="{{ '/' . $subMenuItem->url }}"> <span
                                                    class="badge bg-warning-400">{{ $jml_cuti_hrd }}</span>
                                                {{ $subMenuItem->judul }}</a>
                                        </li>

                                    @elseif ($subMenuItem->url != null)
                                        <li class="{{ Request::is($subMenuItem->url) ? 'active' : null }}"><a
                                                href="{{ '/' . $subMenuItem->url }}">
                                                {{ $subMenuItem->judul }}
                                            </a>
                                        </li>

                                    @else
                                        <li>
                                            <a href="#"><span>{{ $subMenuItem->judul }}</span></a>
                                            <ul>
                                                @foreach ($subMenuItem->children as $thirdMenuItem)
                                                    @if ($thirdMenuItem->url == 'staffPengajuanCuti')
                                                        @if ($jml_bawahan != 0)

                                                            <li
                                                                class="{{ Request::is($thirdMenuItem->url) ? 'active' : null }}">
                                                                <a href="{{ '/' . $thirdMenuItem->url }}"> <span
                                                                        class="badge bg-warning-400">{{ $jml_pengajuan_cuti_bawahan }}</span>
                                                                    {{ $thirdMenuItem->judul }}</a>
                                                            </li>
                                                        @endif
                                                    @else
                                                        <li
                                                            class="{{ Request::is($thirdMenuItem->url) ? 'active' : null }}">
                                                            <a href="{{ '/' . $thirdMenuItem->url }}">
                                                                {{ $thirdMenuItem->judul }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>

                        </li>

                    @else
                        <li>
                            <a href="#"><i class="{{ $menuItem->icon }}"></i> <span>{{ $menuItem->judul }}</span></a>
                            <ul>
                                @foreach ($menuItem->children as $subMenuItem)

                                    @if ($subMenuItem->url == 'staffPengajuanCuti')
                                        @if ($jml_bawahan != 0)

                                            <li class="{{ Request::is($subMenuItem->url) ? 'active' : null }}">
                                                <a href="{{ '/' . $subMenuItem->url }}"> <span
                                                        class="badge bg-warning-400">{{ $jml_pengajuan_cuti_bawahan }}</span>
                                                    {{ $subMenuItem->judul }}</a>
                                            </li>
                                        @endif
                                    @elseif ($subMenuItem->url == 'hrdPengajuanCuti')
                                        <li class="{{ Request::is($subMenuItem->url) ? 'active' : null }}">
                                            <a href="{{ '/' . $subMenuItem->url }}"> <span
                                                    class="badge bg-warning-400">{{ $jml_cuti_hrd }}</span>
                                                {{ $subMenuItem->judul }}</a>
                                        </li>

                                    @elseif ($subMenuItem->url != null)
                                        <li class="{{ Request::is($subMenuItem->url) ? 'active' : null }}"><a
                                                href="{{ '/' . $subMenuItem->url }}">
                                                {{ $subMenuItem->judul }}
                                            </a>
                                        </li>

                                    @else
                                        <li>
                                            <a href="#"><span>{{ $subMenuItem->judul }}</span></a>
                                            <ul>
                                                @foreach ($subMenuItem->children as $thirdMenuItem)
                                                    @if ($thirdMenuItem->url == 'staffPengajuanCuti')
                                                        @if ($jml_bawahan != 0)

                                                            <li
                                                                class="{{ Request::is($thirdMenuItem->url) ? 'active' : null }}">
                                                                <a href="{{ '/' . $thirdMenuItem->url }}"> <span
                                                                        class="badge bg-warning-400">{{ $jml_pengajuan_cuti_bawahan }}</span>
                                                                    {{ $thirdMenuItem->judul }}</a>
                                                            </li>
                                                        @endif
                                                    @else
                                                        <li
                                                            class="{{ Request::is($thirdMenuItem->url) ? 'active' : null }}">
                                                            <a href="{{ '/' . $thirdMenuItem->url }}">
                                                                {{ $thirdMenuItem->judul }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endcan
            @endif
        @endif

    @endforeach

    {{-- @can('menu-staff')
        <li class="navigation-header"><span>Menu Staff</span> <i class="icon-menu"></i></li>
    @endcan
    @can('menu-staff')
        <li class="{{ Request::segment(1) === 'staff' ? 'active' : null }}"><a href="staff"><i
                    class="icon-rocket"></i>
                <span>Dashboard Staff</span></a>
        </li>
    @endcan
    @can('menu-staff')
        <li class="<?php if (Route::is('staffCuti.index') || Route::is('staffCuti.show')) {
    echo 'active';
} ?>"><a href="staffCuti"><i class="icon-history"></i> <span>Riwayat
                    Pengajuan Cuti
                </span>
            </a>
        </li>
    @endcan
    @can('menu-staff')
        <li>
            <a href="#"><i class="icon-furniture"></i> <span>Pengajuan Cuti</span>
                @if ($jml_bawahan != 0)
                    <span class="badge bg-warning-400">{{ $jml_pengajuan_cuti_bawahan }}</span>
                @endif
            </a>
            <ul>
                <li class="<?php if (Route::is('staffCuti.create')) {
    echo 'active';
} ?>"><a href="{{ route('staffCuti.create') }}">Buat Pengajuan Cuti</a>
                </li>
                @if ($jml_bawahan != 0)
                    <li class="{{ Request::segment(1) === 'staffPengajuanCuti' ? 'active' : null }}"><a
                            href="{{ route('staffPengajuanCuti.index') }}"> <span
                                class="badge bg-warning-400">{{ $jml_pengajuan_cuti_bawahan }}</span>
                            Pengajuan Cuti Pegawai</a>
                    </li>
                @endif
            </ul>
        </li>
    @endcan

    @if (!$role_hak_akses->isEmpty())
        <li class="navigation-header"><span>Main Menu</span> <i class="icon-menu"></i></li>
    @endif
    @can('dashboard-admin')
        <li class="{{ Request::segment(1) === 'superAdmin' ? 'active' : null }}"><a
                href="{{ route('superAdmin.index') }}"><i class="icon-rocket"></i> <span>Dashboard Admin</span></a>
        </li>
    @endcan

    @can('dashboard-hrd')
        <li class="{{ Request::segment(1) === 'hrd' ? 'active' : null }}"><a href="{{ route('hrd.index') }}"><i
                    class="icon-rocket"></i> <span>Dashboard HRD</span></a>
        </li>
    @endcan

    @can('manajemen-role')
        <li class="{{ Request::segment(1) === 'role' ? 'active' : null }}"><a href="{{ route('role.index') }}"><i
                    class="icon-key"></i> <span>Manajemen Role</span></a>
        </li>
    @endcan

    @can('menu-kebijakan-kantor')
        <li class="{{ Request::segment(1) === 'peraturan' ? 'active' : null }}"><a
                href="{{ route('peraturan.index') }}"><i class=" icon-info3"></i> <span>Kebijakan Cuti & Jam
                    Kantor</span></a>
        </li>
    @endcan

    @can('menu-pegawai')
        <li class="{{ Request::segment(1) === 'pegawai' ? 'active' : null }}"><a
                href="{{ route('pegawai.index') }}"><i class="icon-users" title="Data Pegawai"></i><span>Data
                    Pegawai</span></a>
        </li>
    @endcan

    @can('menu-jabatan')
        <li>
            <a href="#"><i class="icon-user-tie"></i> <span>Data Jabatan</span></a>
            <ul>
                <li class="{{ Request::segment(1) === 'jabatan' ? 'active' : null }}"><a
                        href="{{ route('jabatan.index') }}">List Data Jabatan</a>
                </li>
                <li class="{{ Request::segment(1) === 'riwayatJabatan' ? 'active' : null }}"><a
                        href="{{ route('riwayatJabatan.index') }}">Data Riwayat Jabatan</a>
                </li>
            </ul>
        </li>
    @endcan

    @can('menu-divisi')
        <li>
            <a href="#"><i class="icon-hat"></i> <span>Data Divisi</span></a>
            <ul>
                <li class="{{ Request::segment(1) === 'divisi' ? 'active' : null }}"><a
                        href="{{ route('divisi.index') }}">List Data Divisi</a>
                </li>
                <li class="{{ Request::segment(1) === 'riwayatDivisi' ? 'active' : null }}"><a
                        href="{{ route('riwayatDivisi.index') }}">Data Riwayat Divisi</a>
                </li>
            </ul>
        </li>
    @endcan

    @can('menu-presensi')
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
    @endcan

    @can('menu-cuti')
        <li>
            <a href="#"><i class="icon-furniture"></i> <span>Data Cuti</span></a>
            <ul>
                <li class="{{ Route::is('cuti.index') ? 'active' : null }}"><a href="{{ route('cuti.index') }}">List
                        Data Cuti</a>
                </li>
                <li class="{{ Route::is('cuti.cutiBersama') ? 'active' : null }}"><a
                        href="{{ route('cuti.cutiBersama') }}">Atur Tanggal Cuti Bersama</a></li>
                <li class="{{ Request::segment(1) === 'rekapCuti' ? 'active' : null }}"><a
                        href="{{ route('rekapCuti.index') }}">Rekapan Data Cuti Pegawai</a></li>
            </ul>
        </li>
    @endcan --}}

</ul>

{{-- <div class="admin" @if ($user->id_role != 1) {{ 'hidden' }} @endif>
    <ul class="navigation navigation-main navigation-accordion">
        <!-- Main -->
        <li class="navigation-header"><span>Menu Super Admin</span> <i class="icon-menu"></i></li>
        <li class="{{ Request::segment(1) === 'superAdmin' ? 'active' : null }}"><a
                href="{{ route('superAdmin.index') }}"><i class="icon-rocket"></i> <span>Dashboard</span></a>
        </li>
        <li class="{{ Request::segment(1) === 'role' ? 'active' : null }}"><a
                href="{{ route('role.index') }}"><i class="icon-key"></i> <span>Manajemen Role</span></a>
        </li>
        <li class="{{ Request::segment(1) === 'peraturan' ? 'active' : null }}"><a
                href="{{ route('peraturan.index') }}"><i class=" icon-info3"></i> <span>Kebijakan Cuti & Jam
                    Kantor</span></a>
        </li>
        <li class="{{ Request::segment(1) === 'pegawai' ? 'active' : null }}"><a
                href="{{ route('pegawai.index') }}"><i class="icon-users" title="Data Pegawai"></i><span>Data
                    Pegawai</span></a>
        </li>
        <li>
            <a href="#"><i class="icon-user-tie"></i> <span>Data Jabatan</span></a>
            <ul>
                <li class="{{ Request::segment(1) === 'jabatan' ? 'active' : null }}"><a
                        href="{{ route('jabatan.index') }}">List Data Jabatan</a>
                </li>
                <li class="{{ Request::segment(1) === 'riwayatJabatan' ? 'active' : null }}"><a
                        href="{{ route('riwayatJabatan.index') }}">Data Riwayat Jabatan</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="icon-hat"></i> <span>Data Divisi</span></a>
            <ul>
                <li class="{{ Request::segment(1) === 'divisi' ? 'active' : null }}"><a
                        href="{{ route('divisi.index') }}">List Data Divisi</a>
                </li>
                <li class="{{ Request::segment(1) === 'riwayatDivisi' ? 'active' : null }}"><a
                        href="{{ route('riwayatDivisi.index') }}">Data Riwayat Divisi</a>
                </li>
            </ul>
        </li>


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

    </ul>
</div>



<div class="hrd" @if ($user->id_role != 2) {{ 'hidden' }} @endif>
    <ul class="navigation navigation-main navigation-accordion">
        <!-- hrd -->
        <li class="navigation-header"><span>Menu HRD</span> <i class="icon-menu"></i></li>
        <li class="{{ Request::segment(1) === 'hrd' ? 'active' : null }}"><a href="{{ route('hrd.index') }}"><i
                    class="icon-rocket"></i> <span>Dashboard</span></a>
        </li>
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
                    class="badge bg-warning-400">{{ $jml_cuti_hrd }}</span></a>
            <ul>
                <li class="<?php if (Route::is('hrdCuti.index') || Route::is('hrdCuti.search')) {
    echo 'active';
} ?>"><a href="{{ route('hrdCuti.index') }}">List Data Cuti</a>
                </li>
                <li class="{{ Route::is('hrdCuti.cutiBersama') ? 'active' : null }}"><a
                        href="{{ route('hrdCuti.cutiBersama') }}">Atur Tanggal Cuti Bersama</a></li>
                <li class="{{ Request::segment(1) === 'hrdPengajuanCuti' ? 'active' : null }}"><a
                        href="{{ route('hrdPengajuanCuti.index') }}"> <span
                            class="badge bg-warning-400">{{ $jml_cuti_hrd }}</span>
                        Pengajuan Cuti Pegawai</a>
                </li>
                <li class="{{ Request::segment(1) === 'rekapCuti' ? 'active' : null }}"><a
                        href="{{ route('rekapCuti.index') }}">Rekapan Data Cuti Pegawai</a></li>
            </ul>
        </li>
        <!-- /hrd -->

    </ul>
</div> --}}
