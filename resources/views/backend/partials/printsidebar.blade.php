<aside id="leftsidebar" class="sidebar">
    <div class="menu">
            <ul class="list lefts">
                <li class="header">MENU LAPORAN</li>
                <li>
                    <a href="{{ route('adm.laporan') }}" class=" waves-effect waves-block">
                        <i class="material-icons">assignment</i>
                        <span>Laporan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adm.laporanbulan') }}" class=" waves-effect waves-block">
                        <i class="material-icons">layers</i>
                        <span>Lap. Bulanan</span>
                    </a>
                </li>
{{--                 <li>
                    <a href="{{ route('adm.laporantahun') }}" class=" waves-effect waves-block">
                        <i class="material-icons">layers</i>
                        <span>Lap. Tahunan</span>
                    </a>
                </li> --}}
                <li>
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
                </li>
                
            </ul>
    </div>
</aside>