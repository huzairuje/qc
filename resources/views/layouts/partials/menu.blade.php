<!--Menu -->
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
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is('tabulasi.create', 'tabulasi.index', 'tabulasi.quickcount')? 'toggled':''}}">
                            <i class="material-icons">trending_up</i>
                            <span>Tabulasi</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li {{Route::is('tabulasi.create')? 'class=active':''}}>
                                <a href="{{route('tabulasi.create')}}">Input Tabulasi</a>
                            </li>
                            <li {{Route::is('tabulasi.index')? 'class=active':''}}>
                                <a href="{{route('tabulasi.index')}}">Hasil Tabulasi</a>
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
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is('approval.create', 'approval.index')? 'toggled':''}}" >
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
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is('monitoring.datasaksi', 'monitoring.datapjtps', 'monitoring.presensipetugas', 'monitoring.tabulasi', 'monitoring.foto', 'monitoring.loginterakhir', 'monitoring.quickrealcount' )? 'toggled':''}}" >
                            <i class="material-icons">library_books</i>
                            <span>Monitoring</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li {{Route::is('monitoring.datasaksi')? 'class=active':''}}>
                                <a href="{{route('monitoring.datasaksi')}}">
                                Data Saksi PKS</a>
                            </li {{Route::is('monitoring.datasaksi')? 'class=active':''}}>
                            <li >
                                <a href="{{route('monitoring.datasaksi')}}">Data Saksi Gerindra</a>
                            </li>
                            <li {{Route::is('monitoring.datapjtps')? 'class=active':''}}>
                                <a href="{{route('monitoring.datapjtps')}}">Data PJ TPS</a>
                            </li>
                            <li {{Route::is('monitoring.presensipetugas')? 'class=active':''}}>
                                <a href="{{route('monitoring.presensipetugas')}}">Presensi Tugas</a>
                            </li>
                            <li {{Route::is('monitoring.tabulasi')? 'class=active':''}}>
                                <a href="{{route('monitoring.tabulasi')}}">Tabulasi</a>
                            </li>
                            <li {{Route::is('monitoring.foto')? 'class=active':''}}>
                                <a href="{{route('monitoring.foto')}}">Foto</a>
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
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block {{Route::is('data_master.create', 'data_master.index')? 'toggled':''}}" >
                            <i class="material-icons">dns</i>
                            <span>Data Master</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li {{Route::is('data_master.create')? 'class=active':''}}>
                                <a href="{{route('data_master.create')}}">Input Data Master</a>
                            </li>
                            <li {{Route::is('data_master.index')? 'class=active':''}}>
                                <a href="{{route('data_master.index')}}">Hasil Data Master</a>
                            </li>
                        </ul>
                    </li>
            
                    <!-- <li {{Route::is('helper')? 'class=active':''}}>
                        <a href="{{route('helper')}}">
                            <i class="material-icons">layers</i>
                            <span>Helper Classes</span>
                        </a>
                    </li>
                    <li {{Route::is('widget')? 'class=active':''}}>
                        <a href="{{route('widget')}}">
                            <i class="material-icons">widgets</i>
                            <span>Widgets</span>
                        </a>
                    </li>
                    <li {{Route::is('table')? 'class=active':''}}>
                        <a href="{{route('table')}}">
                            <i class="material-icons">view_list</i>
                            <span>Tables</span>
                        </a>
                    </li>
                    <li {{Route::is('media')? 'class=active':''}}>
                        <a href="{{route('media')}}">
                            <i class="material-icons">perm_media</i>
                            <span>Medias</span>
                        </a>
                    </li>
                    <li {{Route::is('chart')? 'class=active':''}}>
                        <a href="{{route('chart')}}">
                            <i class="material-icons">pie_chart</i>
                            <span>Charts</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_copy</i>
                            <span>Example Pages</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('login')}}">Sign In</a>
                            </li>
                            <li>
                                <a href="{{route('register')}}">Sign Up</a>
                            </li>
                            <li>
                                <a href="{{route('password.request')}}">Forgot Password</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">trending_down</i>
                            <span>Multi Level Menu</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item - 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Level - 2</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Menu Item</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle">
                                            <span>Level - 3</span>
                                        </a>
                                        <ul class="ml-menu">
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>Level - 4</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
            <!-- #Menu -->