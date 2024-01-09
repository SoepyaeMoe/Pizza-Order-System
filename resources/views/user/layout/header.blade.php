<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                href="{{ route('home') }}" style="height: 65px; padding: 0 30px;">
                <h6 class="h4 text-dark m-0">My Food Shop</h6>
            </a>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">My</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ route('home') }}" class="nav-item nav-link @yield('nav_home_active')">Home</a>
                        <a href="{{ route('product.cart') }}" class="nav-item nav-link @yield('nav_cart_active')">My Cart</a>
                        <a href="{{ route('contact') }}" class="nav-item nav-link @yield('nav_contact_active')">Contact</a>
                    </div>
                    <div class="dropdown">
                        <button class="btn bg-dark text-white btn-sm btn-warning mr-2 dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user mr-2"></i>{{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item py-2 px-2" href="#">Account</a></li>
                            @if (Auth::user()->oauth_type != 'google')
                                <li><a class="dropdown-item py-2 px-2" href="{{ route('change_password') }}">Change
                                        Password</a>
                                </li>
                            @endif
                            <li><a href="#" class="dropdown-item btn p-0"
                                    onclick="return confirm('Are you sure, you want to logout.')">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-dark btn-sm ml-2 text-white">Logout</button>
                                    </form>
                                </a></li>
                        </ul>
                    </div>

                    <a href="{{ route('product.cart') }}" class="btn px-0 ml-3">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span class="badge text-secondary border border-secondary rounded-circle"
                            style="padding-bottom: 2px;">{{ Auth::user()->cart->count() }}</span>
                    </a>
                    <a href="{{ url('product/order') }}" class="btn px-0 ml-3">
                        <i class="fa-solid fa-clock-rotate-left text-primary"></i>
                        <span class="badge text-secondary border border-secondary rounded-circle"
                            style="padding-bottom: 2px;">{{ Auth::user()->order->count() }}</span>
                    </a>
                </div>
        </div>
        </nav>
    </div>
</div>
</div>
