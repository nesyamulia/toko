<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="/" class="navbar-brand">
                <h1 class="text-primary display-6">NersMart</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="/"
                        class="nav-item nav-link {{ request()->routeIs('/') ? 'active' : '' }}">Home</a>
                    <a href="/category"
                        class="nav-item nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}">Shop</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="/cart" class="dropdown-item">Cart</a>
                            <a href="/checkout" class="dropdown-item">Checkout</a>
                        </div>
                    </div>
                    <a href="/contact"
                        class="nav-item nav-link {{ request()->routeIs('contact.index') ? 'active' : '' }}">Contact</a>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('wishlist') }}" class="icon-spacing mx-3">
                        <i class="fa fa-heart fa-2x" aria-hidden="true"></i>
                    </a>
                    <a href="/cart" class="icon-spacing position-relative mx-3">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        @if (Auth::guard('users')->check())
                            <span
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                                {{ Cart::instance('cart_' . Auth::guard('users')->user()->id)->count() }}
                            </span>
                        @else
                            <span
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                                0
                            </span>
                        @endif
                    </a>
                    @if (Auth::guard('users')->check())
                        <a href="{{ route('account') }}" class="icon-spacing mx-3 d-flex align-items-center">
                            <i class="fas fa-user fa-2x"></i>
                            <span class="ms-2">{{ Auth::guard('users')->user()->name }}</span>
                        </a>
                        <a href="{{ route('customer.logout') }}" class="icon-spacing mx-3">
                            <i class="bi bi-box-arrow-right fa-2x" aria-hidden="true"></i>
                        </a>
                    @else
                        <a href="/customer/login" class="icon-spacing mx-3">
                            <i class="fas fa-user fa-2x"></i>
                        </a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->