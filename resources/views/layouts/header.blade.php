<div class="page-header">
    <nav class="navbar navbar-expand-lg d-flex justify-content-between">
        <div class="" id="navbarNav">
            <ul class="navbar-nav" id="leftNav">
                <li class="nav-item">
                    <a class="nav-link" id="sidebar-toggle" href="#"><i data-feather="arrow-left"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help</a>
                </li>
            </ul>
        </div>
        <div class="logo">
            <a href="{{ route('dashboard.index') }}">
            <img src="{{ url('img/logo.png') }}" alt="" style="height:30px" class="logo-img">
            </a>
        </div>
        <div class="" id="headerNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"><b>{{ number_format(auth()->user()->points) }}</b> Points</i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ 'https://ui-avatars.com/api/?background=random&rounded=true&name=' . auth()->user()->name }}" alt=""></a>
                    <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
                        <a class="dropdown-item" href="#"><i data-feather="user"></i>Profile</a>
                        <a class="dropdown-item" href="#"><i data-feather="check-circle"></i>Tasks</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i data-feather="settings"></i>Settings</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="log-out"></i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>