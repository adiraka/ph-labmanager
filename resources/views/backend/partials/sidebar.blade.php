<section>
    <aside id="leftsidebar" class="sidebar">
        <div class="menu">
            <ul class="list">
                <li class="header">MENU NAVIGASI</li>
                <li>
                    <a href="{{ route('adm.beranda') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adm.pasien') }}">
                        <i class="material-icons">face</i>
                        <span>Pasien</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adm.sampel') }}">
                        <i class="material-icons">local_pharmacy</i>
                        <span>Sampel</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adm.instansi') }}">
                        <i class="material-icons">account_balance</i>
                        <span>Institusi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adm.kuisioner') }}">
                        <i class="material-icons">textsms</i>
                        <span>Kuisioner</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adm.laporanbulan') }}">
                        <i class="material-icons">assignment</i>
                        <span>Laporan Bulanan</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block toggled">
                        <i class="material-icons">widgets</i>
                        <span>Laporan Parsial</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('adm.laporanpasien') }}" class="waves-effect waves-block">
                                <span>Pasien</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('adm.laporansampel') }}" class="waves-effect waves-block">
                                <span>Sampel</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('adm.laporaninstitusi') }}" class="waves-effect waves-block">
                                <span>Institusi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('adm.laporankuisioner') }}" class="waves-effect waves-block">
                                <span>Kuisioner</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
        <div class="legal">
            <div class="copyright">
                © 2017 
                <a href="javascript:void(0);">Peer health - MDRTB Research</a>.
            </div>
            <div class="version">
            <img src="{{ asset('img/amilabmanagerlogo.png') }}" alt=""> Ami Labmanager v.3.2
            </div>
        </div>
    </aside>
</section>