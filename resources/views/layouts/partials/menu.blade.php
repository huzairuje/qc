<!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li {{Route::is('dashboard')? 'class=active':''}}>
                        <a href="{{route('dashboard')}}">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is( 'tabulasi*')? 'toggled':''}}">
                            <i class="material-icons">trending_up</i>
                            <span>Tabulasi</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li {{Route::is('tabulasi.create')? 'class=active':''}}>
                                <a href="{{route('tabulasi.create')}}">Create Data Tabulasi</a>
                            </li>
                            <li {{Route::is('tabulasi.index') || Route::is('tabulasi.show')? 'class=active':''}}>
                                <a href="{{route('tabulasi.index')}}">Tabulasi Index</a>
                            </li>
                            <li {{Route::is('tabulasi.quickcount')? 'class=active':''}}>
                                <a href="{{route('tabulasi.quickcount')}}">Hasil Quick Count</a>
                            </li>    
                        </ul>                   
                    </li>
                    <li {{Route::is('download')? 'class=active':''}}>
                        <a href="{{route('download')}}">
                            <i class="material-icons">file_download</i>
                            <span>Download</span>
                        </a>
                    </li>
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
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is('monitoring*')? 'toggled':''}}" >
                            <i class="material-icons">notifications_none</i>
                            <span>Monitoring</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li {{Route::is('monitoring.datasaksi')? 'class=active':''}}>
                                <a href="{{route('monitoring.datasaksi')}}">Data Saksi</a>
                            </li>
                            <li {{Route::is('monitoring.datapjtps')? 'class=active':''}}>
                                <a href="{{route('monitoring.datapjtps')}}">Hasil Approval</a>
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
                    
                    
                    <li class="header">SETTING</li>
                        <li {{Route::is('users.profile')? 'class=active':''}}>
                        <a href="{{route('users.profile')}}">
                            <i class="material-icons">perm_identity</i>
                            <span>User</span>
                        </a>
                    </li>
            
                   
                </ul>
            </div>
            <!-- #Menu 