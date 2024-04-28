<!--================Header Menu Area =================-->
<header class="header_area">
    <div class="top_menu">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="float-left">
              <p>Phone: +62 8123 1588 180</p>
              <p>email: clothingstore@gmail.com</p>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="float-right">
              <ul class="right_side">
                <li>
                  <a href="/tracking">
                    track order
                  </a>
                </li>
                <li>
                  <a href="/contact">
                    Contact Us
                  </a>
                </li>
                <li>
                  <a href="/customer/login">
                    Login/Register
                  </a>
                </li>
          
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <style>
    .img-logo {
        width: 130px; /* ganti dengan ukuran yang Anda inginkan */
        height: auto; /* agar rasio aspek gambar tetap terjaga */
    }
</style>
    <div class="main_menu">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light w-100">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="/">
            <img src="../img/new-icon.png" alt="" class="img-logo"/>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
    <div class="row w-100 mr-0">
        <div class="col-lg-10 pr-0 offset-lg-2">
            <ul class="nav navbar-nav center_nav pull-right">
                <li class="nav-item {{ request()->is('home-page') ? 'active' : '' }}">
                    <a class="nav-link" href="/home-page">Home</a>
                </li>
                <li class="nav-item submenu dropdown {{ request()->is('category*', 'single-product*', 'checkout*', 'cart*') ? 'active' : '' }}">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="/category">Product Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/wishlist-product">Product Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cart">Shopping Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/checkout">Product Checkout</a>
                        </li>
                        
                    </ul>
                </li>
                <li class="nav-item submenu dropdown {{ request()->is('tracking*') ? 'active' : '' }}">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="/tracking">Tracking</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</div>


    <div class="col-lg-5 pr-0">
    <ul class="nav navbar-nav navbar-right right_nav pull-right">
        <li class="nav-item">
            <a href="/cart" class="icons">
                <i class="ti-shopping-cart"></i>
            </a>
        </li>

        <li class="nav-item">
            <a href="/wishlist-product" class="icons">
                <i class="ti-heart" aria-hidden="true"></i>
            </a>
        </li>

        <li class="nav-item">
    <a href="#" class="icons">
        <i class="ti-user" aria-hidden="true"></i>
        @auth
            @if (Auth::user()->roles !== 'admin' && Auth::user()->roles !== 'owner')
                {{ Auth::user()->name }} - customer
            @else
                {{ Auth::user()->name }} - {{ Auth::user()->roles }}
            @endif
        @endauth
    </a>
</li>


        <li class="nav-item">
    <a href="{{ route('logout') }}" class="icons" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="ti-power-off" aria-hidden="true"> SignOut</i> <!-- Ikon logout -->
    </a>
</li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf <!-- Form untuk logout -->
        </form>
    </ul>
</div>

            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <!--================Header Menu Area =================-->