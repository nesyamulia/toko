<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../../assets/img/boutique.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-3 font-weight-bold text-white">Toko Pakaian</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('dashboard') ? 'active bg-gradient-primary' : '' }}" href="/dashboard">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-chart-line fa-pro text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Product Management</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('product-category') ? 'active bg-gradient-primary' : '' }}" href="/product-category">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-tags fa-pro text-success"></i>
            </div>
            <span class="nav-link-text ms-1">Product Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('product') ? 'active bg-gradient-primary' : '' }}" href="/product">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-box fa-pro text-warning"></i>
            </div>
            <span class="nav-link-text ms-1">Products</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('product-review') ? 'active bg-gradient-primary' : '' }}" href="/product-review">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-star fa-pro text-info"></i>
            </div>
            <span class="nav-link-text ms-1">Product Reviews</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('wishlist') ? 'active bg-gradient-primary' : '' }}" href="/wishlist">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-heart fa-pro text-danger"></i>
            </div>
            <span class="nav-link-text ms-1">Wishlist</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Discount Management</h6>
        </li>
        <li class="nav-item">
        <a class="nav-link text-white {{ Request::is('discount-category') ? 'active bg-gradient-primary' : '' }}" href="/discount-category">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-tags fa-pro text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Discount Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('discount') ? 'active bg-gradient-primary' : '' }}" href="/discount">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-percent fa-pro text-secondary"></i>
            </div>
            <span class="nav-link-text ms-1">Discounts</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Transaction Management</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('order') ? 'active bg-gradient-primary' : '' }}" href="/order">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-shopping-basket fa-pro text-success"></i>
            </div>
            <span class="nav-link-text ms-1">Orders</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('order-detail') ? 'active bg-gradient-primary' : '' }}" href="/order-detail">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-receipt fa-pro text-warning"></i>
            </div>
            <span class="nav-link-text ms-1">Order Details</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('delivery') ? 'active bg-gradient-primary' : '' }}" href="/delivery">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-truck fa-pro text-info"></i>
            </div>
            <span class="nav-link-text ms-1">Deliveries</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ Request::is('payment') ? 'active bg-gradient-primary' : '' }}" href="/payment">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-money-check-alt fa-pro text-danger"></i>
            </div>
            <span class="nav-link-text ms-1">Payments</span>
          </a>
        </li>
      
        <li class="nav-item mt-3">
    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
</li>

@if(auth()->check() && Auth::user()->roles !== 'admin')
    <li class="nav-item">
        <a class="nav-link text-white {{ Request::is('user') ? 'active bg-gradient-primary' : '' }}" href="/user">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-users fa-pro text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Users</span>
        </a>
    </li>
@endif

@if(auth()->check() && Auth::user()->roles !== 'admin')
    <li class="nav-item">
        <a class="nav-link text-white {{ Request::is('customer') ? 'active bg-gradient-primary' : '' }}" href="/customer">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-user-friends fa-pro text-secondary"></i>
            </div>
            <span class="nav-link-text ms-1">Customers</span>
        </a>
    </li>
@endif

        
        @if(auth()->check())
<li class="nav-item">
  <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
    <a class="nav-link text-white " href="#" onclick="document.getElementById('logout-form').submit();">
      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="fas fa-sign-out-alt fa-pro text-success"></i>
      </div>
      <span class="nav-link-text ms-1">Sign Out</span>
    </a>
  </form>
</li>
@endif
      </ul>
    </div> 
    </div>
  </aside>
