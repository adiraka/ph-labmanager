<nav class="navbar animate" data-animate='slideInDown'>
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a class="navbar-brand" href="{{ route('adm.beranda') }}">PEER HEALTH MDRTB <p>Laboratorium Manager</p></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
               

                <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>

                 <li><a href="{{ route('adm.beranda') }}" data-close="true"><i class="material-icons">home</i></a></li>
                 {{-- <li><a href="{{ route('adm.laporan') }}" data-close="true"><i class="material-icons">assignment</i></a></li> --}}

                <li class="dropdown hidden-xs">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">portrait</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                        <li role="seperator" class="divider"></li>
                        <li><a href="{{ route('logout') }}"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </li>

                {{-- <li class="pull-right">
                    <a href="javascript:void(0);" class="js-right-sidebar bars" data-close="true"></a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>