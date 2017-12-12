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
                    @if( Sentinel::getUser()->roles->first()->slug == 'admin-pusat' )
                    <li {{Route::is('event.*')? 'class=active':''}}>
                        <a href="{{route('event.index')}}">
                          <i class="material-icons">event</i>
                            <span>Event Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is( 'tabulasi*')? 'toggled':''}}">
                            <i class="material-icons">tab</i>
                            <span>Tabulasi</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li {{Route::is('tabulasi.create')? 'class=active':''}}>
                                <a href="{{route('tabulasi.create')}}">Create Data Tabulasi</a>
                            </li>
                            <li {{Route::is('tabulasi.index') || Route::is('tabulasi.show') || Route::is('tabulasi.edit')? 'class=active':''}}>
                                <a href="{{route('tabulasi.index')}}">Tabulasi Index</a>
                            </li>
                            <li {{Route::is('tabulasi.quickcount')? 'class=active':''}}>
                                <a href="{{route('tabulasi.quickcount')}}">Hasil Quick Count</a>
                            </li>
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
                    @if( Sentinel::getUser()->roles->first()->slug == 'admin-pusat' || Sentinel::getUser()->roles->first()->slug == 'admin-kecamatan' )
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is('approval*')? 'toggled':''}}" >
                            <i class="material-icons">notifications_none</i>
                            <span>Approval</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li {{Route::is('approval.create')? 'class=active':''}}>
                                <a href="{{route('approval.create')}}">Input Approval</a>
                            </li>
                            <li {{Route::is('approval.index')? 'class=active':''}}>
                                <a href="{{route('approval.index')}}">Hasil Approval</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if( Sentinel::getUser()->roles->first()->slug == 'admin-pusat' )
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is('monitoring*')? 'toggled':''}}" >
                            <i class="material-icons">remove_red_eye</i>
                            <span>Monitoring</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                             <li {{Route::is('monitoring.datasaksi') || Route::is('monitoring.datasaksi.create') || Route::is('monitoring.datasaksi.show') || Route::is('monitoring.datasaksi.edit')? 'class=active':''}}>
                                <a href="{{route('monitoring.datasaksi')}}">Data Saksi PAN</a>
                            </li>

                            <li {{Route::is('monitoring.datapjtps') || Route::is('monitoring.datapjtps.create') || Route::is('monitoring.datapjtps.show') || Route::is('monitoring.datapjtps.edit')? 'class=active':''}}>
                                <a href="{{route('monitoring.datapjtps')}}">Data PJ TPS</a>
                            </li>
                            <li {{Route::is('monitoring.tabulasi')? 'class=active':''}}>
                                <a href="{{route('monitoring.tabulasi')}}">Tabulasi</a>
                            </li>
                            <li {{Route::is('monitoring.foto')? 'class=active':''}}>
                                <a href="{{route('monitoring.foto')}}">Foto</a>
                            </li>
                            <li {{Route::is('monitoring.presensipetugas')? 'class=active':''}}>
                                <a href="{{route('monitoring.presensipetugas')}}">Presensi Petugas</a>
                            </li>
                            <li {{Route::is('monitoring.loginterakhir')? 'class=active':''}}>
                                <a href="{{route('monitoring.loginterakhir')}}">Login Terakhir</a>
                            </li>
                            <li {{Route::is('monitoring.quickrealcount')? 'class=active':''}}>
                                <a href="{{route('monitoring.quickrealcount')}}">Quick Real Count</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if( Sentinel::getUser()->roles->first()->slug == 'admin-event' || Sentinel::getUser()->roles->first()->slug == 'admin-pusat' )
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is('datamaster*')? 'toggled':''}}" >
                            <i class="material-icons">input</i>
                            <span>Data Master</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li {{Route::is('datamaster.calon*')? 'class=active':''}}>
                                <a href="{{route('datamaster.calon.index')}}">Calon</a>
                            </li>
                            <li {{Route::is('datamaster.dapil*')? 'class=active':''}}>
                                <a href="{{route('datamaster.dapil.index')}}">Dapil</a>
                            </li>
                            <li {{Route::is('datamaster.TPS*')? 'class=active':''}}>
                                <a href="{{route('datamaster.TPS.index')}}">TPS</a>
                            </li>
                            <li {{Route::is('datamaster.partai*')? 'class=active':''}}>
                                <a href="{{route('datamaster.partai.index')}}">Partai</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is('usermanagement*')? 'toggled':''}}" >
                            <i class="material-icons">people</i>
                            <span>User Management</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li {{Route::is('usermanagement*')? 'class=active':''}}>
                                <a href="{{route('usermanagement.index')}}">Index</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- #Menu
