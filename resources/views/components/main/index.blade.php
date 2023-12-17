<!DOCTYPE html>
<html lang="en">
<head>
@include('components.parts.header')
@yield('header')
</head>
<body>
    <div id="wrapper">
         <!-- Sidebar -->
         <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            

            <li class="nav-item {{Request::path() == 'dashboard' ? 'active':''}}">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item {{Request::path() == 'karyawan' ? 'active':''}}">
                <a class="nav-link" href="/karyawan">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Karyawan</span></a>
            </li>

            <li class="nav-item {{Request::path() == 'user' ? 'active':''}}">
                <a class="nav-link" href="/user">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li>

            {{-- <li class="nav-item {{Request::path() == 'divisi' ? 'active':''}}">
                <a class="nav-link" href="divisi">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Divisi</span></a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link" href="/logout">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            

        </ul>
        <!-- End of Sidebar -->
        @include('components.parts.footer')
        @yield('footer')

        <div id="content-wrapper" class="d-flex flex-column bg-gray-200">
            <div id="content">
                <div class="container-fluid p-4 my-4">
                <!-- Main Content -->
                    @yield('title-content')
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>    

</body>
</html>