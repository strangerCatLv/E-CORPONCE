<style>
    span{
        color: white;
    }
    #sidebar-menu{
        background: white;
    }
    .simplebar-content-wrapper{
        background: white!important;
    }
    body[data-sidebar="dark"].vertical-collpsed .vertical-menu #sidebar-menu > ul > li:hover > a{
        background: #da241b !important;
        /* border-radius: 10px 30px 0px 30px; */
    }
    body[data-sidebar="dark"] #sidebar-menu ul li a i{
        color: white
    }
    .vertical-collpsed .vertical-menu #sidebar-menu > ul > li:hover > a span{
        color: white;
    }
    .active-color{
        color: white
    }
    .waves-effect1{
        background: #da241b;
        border-radius: 10px;
        color: white !important;
        width: 90%;
        margin-top: 10px;
    }
    .waves-effect1:hover {
        transform: translateY(-5px); /* Menaikkan elemen sejauh 5px saat di hover */
    }
    body[data-sidebar="dark"] .menu-title{
        color: black
    }
    .noti-icon i{
        color: white
    }
</style>
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu" style="background:white">
                @if(auth()->user()->can('dashboard') || auth()->user()->can('master-data') || auth()->user()->can('history-log-list'))
                    {{-- <li class="menu-title" key="t-menu"> Menu </li> --}}
                @endif

                @if(auth()->user()->can('dashboard'))
                    <li>
                        <a href="{{ route('dashboard.index') }}" class="waves-effect waves-effect1 mx-auto " style="background:{{ Request::is('dashboard*') ? '#620500 !important' : '' }};color: {{ Request::is('dashboard*') ? 'white' : '' }}">
                            <i class="bx bx-home-circle"></i>
                            <span key="t-dashboards" class="{{ Request::is('dashboard*') ? 'active-color' : '' }}" style="{{ Request::is('dashboard*') ? 'color:white' : '' }}">Dashboard</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('kop-surat'))
                    <li>
                        <a href="{{ route('kop-surat') }}" class="waves-effect waves-effect1 mx-auto " style="background:{{ Request::is('kop-surat*') ? '#620500 !important' : '' }}; color: {{ Request::is('kop-surat*') ? 'white' : '' }}">
                            <i class="mdi mdi-email-newsletter"></i>
                            <span key="t-dashboards" class="{{ Request::is('kop-surat*') ? 'active-color' : '' }}" style="{{ Request::is('kop-surat*') ? 'color:white' : '' }}">Kop Surat Disposisi</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('kop-surat'))
                    <li>
                        <a href="{{ route('kop-surat-keluar') }}" class="waves-effect waves-effect1 mx-auto " style="background:{{ Request::is('kop-surat-keluar*') ? '#620500 !important' : '' }};color: {{ Request::is('kop-surat-keluar*') ? 'white' : '' }}">
                            <i class="mdi mdi-email-newsletter"></i>
                            <span key="t-dashboards" class="{{ Request::is('kop-surat-keluar*') ? 'active-color' : '' }}" style="{{ Request::is('kop-surat-keluar*') ? 'color:white' : '' }}">Kop Surat Keluar</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('main-menu'))
                    <li>
                        <a class="waves-effect waves-effect1 mx-auto "  href="{{ route('master-data.index') }}" style="background:{{ Request::is('master-data*') ? '#620500 !important' : '' }};color: {{ Request::is('master-data*') ? 'white' : '' }}">
                            <i class="mdi mdi-folder-outline"></i>
                            <span data-key="t-dashboard" style="{{ Request::is('dashboard*') ? 'color:white' : '' }}">Main Menu</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('surat-masuk'))
                    <li>
                        <a class="waves-effect waves-effect1 mx-auto "  href="{{ url('surat-masuk') }}" style="background:{{ Request::is('surat-masuk*') ? '#620500 !important' : '' }};color: {{ Request::is('surat-masuk*') ? 'white' : '' }}">
                            <i class="mdi mdi-email-newsletter"></i>
                            <span data-key="t-dashboard" style="{{ Request::is('surat-masuk') ? 'color:white' : '' }}">Surat Masuk</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('surat-keluar'))
                    <li>
                        <a class="waves-effect waves-effect1 mx-auto "  href="{{ url('surat-keluar') }}" style="background:{{ Request::is('surat-keluar*') ? '#620500 !important' : '' }}; color:{{ Request::is('surat-keluar*') ? 'white' : '' }}">
                            <i class="mdi mdi-email-newsletter"></i>
                            <span data-key="t-dashboard" style="{{ Request::is('surat-keluar') ? 'color:white' : '' }}">Surat Keluar</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('surat-disposisi'))
                    <li>
                        <a class="waves-effect waves-effect1 mx-auto "  href="{{ url('surat-disposisi') }}" style="background:{{ Request::is('surat-disposisi*') ? '#620500 !important' : '' }}; color:{{ Request::is('surat-disposisi*') ? 'white' : '' }}">
                            <i class="mdi mdi-email-newsletter"></i>
                            <span data-key="t-dashboard" style="{{ Request::is('surat-disposisi') ? 'color:white' : '' }}">Surat Disposisi</span>
                        </a>
                    </li>
                @endif
                {{-- @if(auth()->user()->can('assign-tugas'))
                    <li>
                        <a class="waves-effect waves-effect1 mx-auto "  href="{{ url('assign-tugas') }}" style="background:{{ Request::is('assign-tugas*') ? '#620500 !important' : '' }}; ;color: {{ Request::is('assign-tugas*') ? 'white' : '' }}">
                            <i class="mdi mdi-email-newsletter"></i>
                            <span data-key="t-dashboard" style="{{ Request::is('assign-tugas') ? 'color:white' : '' }}">Assign Tugas</span>
                        </a>
                    </li>
                @endif --}}
                @if(auth()->user()->can('laporan-surat-masuk'))
                    <li>
                        <a class="waves-effect waves-effect1 mx-auto "  href="{{ url('laporan-surat-masuk') }}" style="background:{{ Request::is('laporan-surat-masuk*') ? '#620500 !important' : '' }};color:{{ Request::is('laporan-surat-masuk*') ? 'white' : '' }}">
                            <i class="mdi mdi-folder-outline"></i>
                            <span data-key="t-dashboard" style="{{ Request::is('laporan-surat-masuk') ? 'color:white' : '' }}">Laporan Surat Masuk</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('laporan-surat-keluar'))
                    <li>
                        <a class="waves-effect waves-effect1 mx-auto "  href="{{ url('laporan-surat-keluar') }}" style="background:{{ Request::is('laporan-surat-keluar*') ? '#620500 !important' : '' }}; color:{{ Request::is('laporan-surat-keluar*') ? 'white' : '' }}">
                            <i class="mdi mdi-folder-outline"></i>
                            <span data-key="t-dashboard" style="{{ Request::is('laporan-surat-keluar') ? 'color:white' : '' }}">Laporan Surat Keluar</span>
                        </a>
                    </li>
                @endif
                <li>
                    <form action="{{ url('/logout') }}" class="mt-2" method="post">
                        @csrf
                        <button type="submit" class="btn" style="color: white;background: red;margin-left: 9%;"> 
                            <i class="mdi mdi-logout"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->