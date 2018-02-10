<!-- Menu -->
<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li {{Route::is('dashboard') || Route::is('users.profile')? 'class=active':''}}>
            <a href="{{route('dashboard')}}">
                <i class="material-icons">home</i>
                <span>Dashboard</span>
            </a>
        </li>
        @if( Sentinel::getUser()->roles->first()->slug == 'admin-event' || Sentinel::getUser()->roles->first()->slug == 'admin-pusat' )
        <li {{Route::is('event.*')? 'class=active':''}}>
            <a href="{{route('event.index')}}">
                <i class="material-icons">event</i>
                <span>Event Management</span>
            </a>
        </li>
        @endif
        @if( Sentinel::getUser()->roles->first()->slug == 'admin-event' || Sentinel::getUser()->roles->first()->slug == 'admin-pusat' )
        <li>
            <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is('datamaster*')? 'toggled':''}}" >
                <i class="material-icons">input</i>
                <span>Data Master Management</span>
            </a>
            <ul class="ml-menu" style="display: none;">
                <li {{Route::is('datamaster.dapil*')? 'class=active':''}}>
                    <a href="{{route('datamaster.dapil.index')}}">Dapil Management</a>
                </li>
                <li {{Route::is('datamaster.partai*')? 'class=active':''}}>
                    <a href="{{route('datamaster.partai.index')}}">Partai Management</a>
                </li>
                <li {{Route::is('datamaster.TPS*')? 'class=active':''}}>
                    <a href="{{route('datamaster.TPS.index')}}">TPS Management</a>
                </li>
                <li {{Route::is('datamaster.calon*')? 'class=active':''}}>
                    <a href="{{route('datamaster.calon.index')}}">Calon Management</a>
                </li>
            </ul>
        </li>
        @endif
        
        <li>
            <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is( 'tabulasi*')? 'toggled':''}}">
                <i class="material-icons">tab</i>
                <span>Tabulasi</span>
            </a>
            <ul class="ml-menu" style="display: none;">
                <li {{Route::is('tabulasi.create')? 'class=active':''}}>
                    <a href="{{route('tabulasi.create')}}">Tambah Data Tabulasi</a>
                </li>
                @if( Sentinel::getUser()->roles->first()->slug == 'admin-event' || Sentinel::getUser()->roles->first()->slug == 'admin-pusat' || Sentinel::getUser()->roles->first()->slug == 'admin-provinsi' || Sentinel::getUser()->roles->first()->slug == 'admin-kota' || Sentinel::getUser()->roles->first()->slug == 'admin-kecamatan' || Sentinel::getUser()->roles->first()->slug == 'admin-kelurahan')
                <li {{Route::is('tabulasi.index') || Route::is('tabulasi.show') || Route::is('tabulasi.edit')? 'class=active':''}}>
                    <a href="{{route('tabulasi.index')}}">Data Tabulasi</a>
                </li>
                <li {{Route::is('tabulasi.quickcount')? 'class=active':''}}>
                    <a href="{{route('tabulasi.quickcount')}}">Hasil Quick Count</a>
                </li>
                @endif
            </ul>
        </li>
        @if( Sentinel::getUser()->roles->first()->slug == 'admin-pusat' )
        <li>
            <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is('monitoring*')? 'toggled':''}}" >
                <i class="material-icons">remove_red_eye</i>
                <span>Monitoring Management</span>
            </a>
            <ul class="ml-menu" style="display: none;">
                <li {{Route::is('monitoring.datasaksi') || Route::is('monitoring.datasaksi.create') || Route::is('monitoring.datasaksi.show') || Route::is('monitoring.datasaksi.edit')? 'class=active':''}}>
                    <a href="{{route('monitoring.datasaksi')}}">Data Saksi</a>
                </li>

                <li {{Route::is('monitoring.datapjtps') || Route::is('monitoring.datapjtps.create') || Route::is('monitoring.datapjtps.show') || Route::is('monitoring.datapjtps.edit')? 'class=active':''}}>
                    <a href="{{route('monitoring.datapjtps')}}">Data Korsak</a>
                </li>

                <li {{Route::is('monitoring.dataadminkecamatan') || Route::is('monitoring.dataadminkecamatan.create') || Route::is('monitoring.dataadminkecamatan.show') || Route::is('monitoring.dataadminkecamatan.edit')? 'class=active':''}}>
                    <a href="{{route('monitoring.dataadminkecamatan')}}">Data Admin Kecamatan</a>
                </li>

                <li {{Route::is('monitoring.dataadminkota') || Route::is('monitoring.dataadminkota.create') || Route::is('monitoring.dataadminkota.show') || Route::is('monitoring.dataadminkota.edit')? 'class=active':''}}>
                    <a href="{{route('monitoring.dataadminkota')}}">Data Admin Kota</a> 
                </li>

                <li {{Route::is('monitoring.dataadminprovinsi') || Route::is('monitoring.dataadminprovinsi.create') || Route::is('monitoring.dataadminprovinsi.show') || Route::is('monitoring.dataadminprovinsi.edit')? 'class=active':''}}>
                    <a href="{{route('monitoring.dataadminprovinsi')}}">Data Admin Provinsi</a>
                </li>
                <!-- <li {{Route::is('monitoring.dataadminevent') || Route::is('monitoring.dataadminevent.create') || Route::is('monitoring.dataadminevent.show') || Route::is('monitoring.dataadminevent.edit')? 'class=active':''}}>
                    <a href="{{route('monitoring.dataadminevent')}}">Data Admin Event</a>
                </li> -->
                <!-- <li {{Route::is('monitoring.tabulasi')? 'class=active':''}}>
                    <a href="{{route('monitoring.tabulasi')}}">Tabulasi</a>
                </li>
                <li {{Route::is('monitoring.foto')? 'class=active':''}}>
                    <a href="{{route('monitoring.foto')}}">Foto</a> -->
                </li>
                <li {{Route::is('monitoring.loginterakhir*')? 'class=active':''}}>
                    <a href="{{route('monitoring.loginterakhir')}}">Login Terakhir</a>
                </li>

            </ul>
        </li>
        @endif
        @if( Sentinel::getUser()->roles->first()->slug == 'admin-pusat' || Sentinel::getUser()->roles->first()->slug == 'admin-kecamatan' || Sentinel::getUser()->roles->first()->slug == 'korsak' )
        <li {{Route::is('approval.*')? 'class=active':''}}>
            <a href="{{route('approval.index')}}">
                <i class="material-icons">notifications_none</i>
                <span>Approval Management</span>
            </a>
        </li>
        @endif
        @if( Sentinel::getUser()->roles->first()->slug == 'admin-pusat' || Sentinel::getUser()->roles->first()->slug == 'admin-kecamatan' || Sentinel::getUser()->roles->first()->slug == 'korsak' || Sentinel::getUser()->roles->first()->slug == 'saksi' )
        <li {{Route::is('absensi.*')? 'class=active':''}}>
            <a href="{{route('absensi.index')}}">
                <i class="material-icons">people_outline</i>
                <span>Absensi Management</span>
            </a>
        </li>
        @endif
        @if( Sentinel::getUser()->roles->first()->slug == 'admin-event' || Sentinel::getUser()->roles->first()->slug == 'admin-pusat' )
        <li {{Route::is('quickrealcount.*')? 'class=active':''}}>
          <a href="{{route('quickrealcount.index')}}">
              <i class="material-icons">insert_chart</i>
              <span>Quick Real Count Management</span>
          </a>
        </li>
        @endif
        @if( Sentinel::getUser()->roles->first()->slug == 'admin-pusat' || Sentinel::getUser()->roles->first()->slug == 'admin-event' || Sentinel::getUser()->roles->first()->slug == 'admin-provinsi' || Sentinel::getUser()->roles->first()->slug == 'admin-kota' || Sentinel::getUser()->roles->first()->slug == 'admin-kecamatan' || Sentinel::getUser()->roles->first()->slug == 'admin-kelurahan')
        <li>
            <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is('usermanagement*')? 'toggled':''}}" >
                <i class="material-icons">people</i>
                <span>User Management</span>
            </a>
            <ul class="ml-menu" style="display: none;">
                <li {{Route::is('usermanagement*')? 'class=active':''}}>
                    <a href="{{route('usermanagement.index')}}">Data User</a>
                </li>
                <!-- <li {{Route::is('assignuser*')? 'class=active':''}}>
                    <a href="{{route('assignuser.index')}}">Assign User</a>
                </li> -->
            </ul>
        </li>
        @endif
        
        @if( Sentinel::getUser()->roles->first()->slug == 'admin-pusat' )
        <li {{Route::is('download')? 'class=active':''}}>
            <a href="{{route('download')}}">
                <i class="material-icons">file_download</i>
                <span>Download</span>
            </a>
        </li>
        @endif
    </ul>
</div>
<!-- #Menu
