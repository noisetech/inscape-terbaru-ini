<div class="pcoded-inner-navbar main-menu">
    <div class="">

        <div class="main-menu-content">
            <ul>
                <li class="more-details">
                    <a href="user-profile.html"><i class="ti-user"></i>View Profile</a>
                    <a href="#!"><i class="ti-settings"></i>Settings</a>
                    <a href="auth-normal-sign-in.html"><i class="ti-layout-sidebar-left"></i>Logout</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="pcoded-navigation-label"></div>
    <ul class="pcoded-item pcoded-left-item">

        <center>
            <li class="my-4">
                <img src="{{ asset('backend/logo-pln-ni.png') }}" alt="" style="width: 100px">
            </li>
        </center>
        <li>
            <a href="{{ route('dashboard') }}" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                <span class="pcoded-mtext">Dashboard</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
    </ul>
    <div class="pcoded-navigation-label">Management Users</div>
    <ul class="pcoded-item pcoded-left-item mr-4">
        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                <span class="pcoded-mtext">All Fitur</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a href="{{ route('users.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext">Manage Users</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class=" ">
                    <a href="{{ route('role.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext">Manage Role</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('permission.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext">Manage Permission</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="pcoded-navigation-label">Management Master</div>
    <ul class="pcoded-item pcoded-left-item mr-4">
        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="ti-list"></i></span>
                <span class="pcoded-mtext">All Fitur</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">

                <li class=" ">
                    <a href="{{ route('tahun.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext">Tahun</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>

                <li class=" ">
                    <a href="{{ route('barang.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext">Barang</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>


                <li class=" ">
                    <a href="{{ route('unit.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext">Unit</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="pcoded-navigation-label">Management Pengadaan</div>
    <ul class="pcoded-item pcoded-left-item mr-4">
        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="ti-list"></i></span>
                <span class="pcoded-mtext">All Fitur</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">

                <li class=" ">
                    <a href="{{ route('pengadaan') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext">Pengadaan</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>


</div>
