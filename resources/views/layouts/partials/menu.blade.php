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
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block" >
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
                            <li {{Route::is('tabulasi.hasil')? 'class=active':''}}>
                                <a href="{{route('tabulasi.hasil')}}">Hasil Quick Count</a>
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
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block" >
                            <i class="material-icons">notifications_none</i>
                            <span>Approval</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li {{Route::is('approval.create')? 'class=active':''}}>
                                <a href="{{route('approval.create')}}">Input Approval</a>
                            </li>
                            <li>
                                <a href="{{route('approval.index')}}">Hasil Approval</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block" >
                            <i class="material-icons">library_books</i>
                            <span>Monitoring</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li {{Route::is('monitoring')? 'class=active':''}}>
                                <a href="{{route('monitoring')}}">
                                Data Saksi PKS</a>
                            </li>
                            <li >
                                <a href="">Data Saksi Gerindra</a>
                            </li>
                            <li >
                                <a href="">Data PJ TPS</a>
                            </li>
                            <li >
                                <a href="">Presensi Tugas</a>
                            </li>
                            <li >
                                <a href="">Tabulasi</a>
                            </li>
                            <li >
                                <a href="">Foto</a>
                            </li>
                            <li >
                                <a href="">Login Terakhir</a>
                            </li>
                            <li >
                                <a href="">Quick Real Count</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block" >
                            <i class="material-icons">dns</i>
                            <span>Data Master</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li {{Route::is('data_master')? 'class=active':''}}>
                                <a href="{{route('data_master')}}">Input Data Master</a>
                            </li>
                            <li>
                                <a href="">Hasil Data Master</a>
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