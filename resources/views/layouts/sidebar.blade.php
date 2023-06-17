<div class="page-sidebar">
    <ul class="list-unstyled accordion-menu">
        <li class="sidebar-title">
            Main
        </li>
        <li class="{{ Route::currentRouteName() == 'dashboard.index' ? 'active-page':'' }}">
            <a href="{{ route('dashboard.index') }}"><i data-feather="home"></i>Dashboard</a>
        </li>
        @if (auth()->user()->level == 1)
        <li>
            <a href="{{ route('dashboard.department') }}"><i data-feather="inbox"></i>Department</a>
        </li>
        <li>
            <a href="{{ route('dashboard.employee') }}"><i data-feather="user"></i>Employee</a>
        </li>
        @endif
        <li class="sidebar-title">
            Apps
        </li>
        <li class="{{ Route::currentRouteName() == 'dashboard.leaderboard' ? 'active-page':'' }}">
            <a href="{{ route('dashboard.leaderboard') }}"><i data-feather="message-circle"></i>LeaderBoard</a>
        </li>
        <li>
            <a href=""><i data-feather="shopping-bag"></i>Reward and Redeem</a>
        </li>
        <li>
            <a href=""><i data-feather="users"></i>Mentoring</a>
        </li>
    </ul>
</div>