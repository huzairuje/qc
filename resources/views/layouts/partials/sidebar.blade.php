<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="http://via.placeholder.com/350x150" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Sentinel::getUser()->roles()->first()->name }}</div>
                <div class="email">{{ Sentinel::getUser()->email }}</div>


                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="{{route('users.profile')}}">
                                <i class="material-icons">perm_identity</i>Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>Sign Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <!-- <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        @include('layouts.partials.menu')
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2018 <a href="javascript:void(0);">QuickCount</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.4
            </div>
        </div>
            <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>
