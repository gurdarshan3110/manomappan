<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center ">
                <img src="{{ asset('images/logo.png') }}" alt="logo">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.about') }}">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.contact') }}">Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('pages.login') }}">Login</a>
                    </li>
                </ul>
            </div>    
        </nav>
    </div>    
</header>
