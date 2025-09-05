   <header class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home')}}">
                <i class="fas fa-om text-primary fs-3 me-2"></i>
                <span class="brand-text">BandBazaBarat</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('search') }}">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('match') }}">Matches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('membership') }}">Membership</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('success_storiess') }}">Success Stories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">contact Us</a>
                    </li>
                </ul>
                
               <div class="d-flex gap-2">
    @auth
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
    @endauth
    
</div>

            </div>
        </div>
    </header>