<!-- Top Bar -->
<nav class="navbar bg-cyan">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard Quick Count</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">account_circle</i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"></li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="{{route('users.profile')}}">
                                            <div class="icon-circle bg-light-blue">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>User</h4>
                                                <p>
                                                    Profile User dan Setting
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <div class="icon-circle bg-light-blue">
                                                <i class="material-icons">power_settings_new</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>LogOut</h4>
                                                <p>
                                                    LogOut From this Website
                                                </p>
                                            </div>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
        </div>
    </div>
</nav>