<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #008B8B;">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}" style="font-weight: 600">
            <img src="{{ asset('assets/landingpage/img/logodelisa.png') }}" alt="Warung Sayur D'Lisa Logo" width="50">
            Warung Sayur D'Lisa
        </a>

        <!-- Tombol Toggle (hanya muncul pada mode responsif) -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Isi Navbar (Sisi Kanan) -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-flex">
                    <a class="nav-link" href="#" style="font-size: 15px;  color: white; font-weight: 400">
                        <i class="fas fa-shopping-cart" style="font-size: 16px; width: 25px;"></i> Keranjang
                    </a>
                </li>
                <li class="nav-item d-flex">
                    <a class="nav-link" style="font-size: 15px;  color: white; font-weight: 400" href="{{ route('login') }}">
                        <i class="fas fa-user-circle" style="font-size: 16px; width: 25px;"></i> Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
