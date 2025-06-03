<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center ">
                <img src="{{ asset('images/logo.png') }}" alt="logo">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            @guest
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pages.about') }}">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pages.contact') }}">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pages.login') ? 'active' : '' }}"
                                href="{{ route('pages.login') }}">Login</a>
                        </li>
                    </ul>
                </div>
            @else
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                                href="{{ route('user.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('counselling.history') ? 'active' : '' }}"
                                href="{{ route('user.dashboard') }}">Counselling History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pages.contact') ? 'active' : '' }}"
                                href="{{ route('pages.contact') }}">Contact us</a>
                        </li>
                    </ul>
                </div>
                <div class="profile">
                    <div class="user">{{ get_initials(auth()->user()->name) }}</div>
                    <div class="img-box">
                        <img src="{{ asset('images/toggle.png') }}" alt="some user image">
                    </div>
                </div>
                <div class="menu">
                    <ul>
                        <li><a href="{{ route('user.profile') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('user.logout') }}">
                                @csrf
                                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Sign Out
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
        </nav>
    </div>
</header>
