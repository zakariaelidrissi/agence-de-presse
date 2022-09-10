<header>
    <!-- Top Bar Start -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6 my-md-auto mb-2">
                    <div class="tb-contact">
                        <p><i class="fas fa-envelope"></i>info@mail.com</p>
                        <p><i class="fas fa-phone-alt"></i>+012 345 6789</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tb-menu">
                        @if (Route::has('login'))                        
                            @auth
                                {{-- <a href="{{ route('home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a> --}}
                                <a href="{{ route('home') }}" class="btn btn-primary">{{ auth()->user()->prenom }}</a>
                            @else
                                {{-- <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a> --}}
                                <a href="{{ route('login') }}" class="btn btn-primary">login</a>
                                @if (Route::has('register'))
                                    {{-- <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a> --}}
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                                @endif
                            @endauth
                        @endif
                        {{-- <a href="#" class="btn btn-primary">login</a>
                        <a href="#" class="btn btn-outline-primary">logup</a> --}}
                    </div>
                </div>
            </div>
            <!-- if user est connecter -->
            {{-- <div class="dropdown no-arrow d-flex justify-content-end">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-md-inline text-white small">Nom Prenom</span>
                        <img class="img-profile rounded-circle" src="../img/undraw_profile">
                </a>
                <div class="dropdown-menu dropdown-menu-right py-0 px-0" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider my-1"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                        Logout
                    </a>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- Top Bar Start -->

    <!-- Brand Start -->
    <div class="brand">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4">
                    <div class="b-logo">
                        <a href="index.html">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4"></div>
                <div class="col-lg-3 col-md-4">
                    <div class="b-search">
                        <input type="text" placeholder="Search" />
                        <button><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand End -->

    <!-- Nav Bar Start -->
    <div class="nav-bar py-1">
        <div class="container">
            <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                <a href="#" class="navbar-brand">MENU</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Catégory</a>
                            <div class="dropdown-menu">
                                <a href="./category.html" class="dropdown-item">cat 1</a>
                                <a href="#" class="dropdown-item">cat 2</a>
                                <a href="#" class="dropdown-item">cat 3</a>
                                <a href="#" class="dropdown-item">cat 4</a>
                            </div>
                        </div>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="contact.html" class="nav-item nav-link">Contact Us</a>
                    </div>
                    <div class="social ml-auto">
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-linkedin-in"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Nav Bar End -->
</header>