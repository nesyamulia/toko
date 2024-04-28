@extends('frontend.landingpage.main')
@section('title', 'Product Category Page')
@section('page', 'Product Category Page')
@section('header')
    @include('frontend.landingpage.header')

<style>
  ul.list li a.active::before {
    background-color: green; /* Ganti warna lingkaran menjadi hijau saat link aktif */
}

  ul.list li a.active::before {
    background-color: green; /* Ganti warna lingkaran menjadi hijau saat link aktif */
}

.price_filter {
        margin-top: 20px;
    }

    .price_slider_amount {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        flex-wrap: wrap; /* Mengizinkan item untuk meluncur ke baris baru saat perlu */
    }

    .label-input {
        display: flex;
        align-items: center;
        margin-bottom: 10px; /* Jarak antara item */
    }

    .label-input span {
        margin-right: 5px;
    }

    input[type="text"] {
        width: 100px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
    }

    .btn-filter {
        padding: 10px 20px;
        background-color: #4CAF50; /* Warna hijau */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-left: 5px;
        margin-top: 5px;
    }

    .btn-filter:hover {
        background-color: #45a049; /* Warna hijau yang sedikit lebih gelap saat hover */
    }
 
     /* Style untuk pesan pop-up */
     .custom-alert {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 9999;
    }

    .custom-alert h2 {
        margin-bottom: 10px;
        font-size: 20px;
        color: #333;
    }

    .custom-alert p {
        margin-bottom: 10px;
        font-size: 16px;
        color: #666;
    }

    .custom-alert button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom-alert button:hover {
        background-color: #45a049;
    }
    
    .product-img {
    position: relative;
}

.category-name {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #fff; /* Atur warna latar belakang sesuai kebutuhan */
    padding: 5px 10px; /* Sesuaikan padding sesuai kebutuhan */
    border: 2px solid #ccc; /* Atur gaya border sesuai kebutuhan */
    border-radius: 5px; /* Sesuaikan radius sudut sesuai kebutuhan */
    border-color: green;
}

</style>

    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div class="banner_content d-md-flex justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
              <h2>Product Category</h2>
              <p>Explore our wide range of product categories.</p>
            </div>
            <div class="page_link">
              <a href="/home-page">Home</a>
              <a href="/category">Product Category</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Category Product Area =================-->
    <script src="https://kit.fontawesome.com/e14095a2c4.js" crossorigin="anonymous"></script>
    <section class="cat_product_area section_gap">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="product_top_bar">
                    <!-- Tambahkan id pada elemen select -->
                    <div class="left_dorp">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search Product Name">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const products = document.querySelectorAll('.single-product');

        searchInput.addEventListener('input', function () {
            const searchText = this.value.trim().toLowerCase();

            products.forEach(function (product) {
                const productName = product.querySelector('h4').textContent.trim().toLowerCase();
                if (productName.includes(searchText)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    });
</script>


<form id="addToWishlistForm" action="{{ route('wishlist-product.store') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="product_id" id="product_id_input" value="">
    <!-- Tambahkan input tersembunyi untuk customer_id -->
    <input type="hidden" name="customer_id" id="customer_id_input" value="">
</form>


<div class="latest_product_inner">
    <div class="row">
        @if ($products->isNotEmpty())
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6">
                    <div class="single-product" data-price="{{ $product->price }}">
                        <div class="product-img">
                            <a href="/single-product/{{ $product->id }}">
                                <img class="card-img" src="{{ asset($product->image1_url) }}" alt="{{ $product->product_name }}" style="max-width: 100%; max-height: 100%;">
                            </a>
                            <div class="p_icon">
                                <a href="/single-product/{{ $product->id }}"><i class="ti-eye"></i></a>
                                <a href="#" onclick="event.preventDefault(); addToWishlist('{{ $product->id }}');"><i class="ti-heart"></i></a>
                                <a href="/cart"><i class="ti-shopping-cart"></i></a>
                            </div>
                            <span class="category-name">{{ $product->category->category_name }}</span>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>{{ $product->product_name }}</h4>
                            </a>
                            <div class="mt-3">
                            @if ($product->percentage && isset($product->discounted_price))
                                <div>Discount {{ $product->discount_category_name }}</div>
                                <span class="badge badge-success" style="font-size: 12px; color: white; font-weight: bold;">{{ $product->percentage }}% Off</span>
                                <del>${{ $product->price }}</del><br>
                                <span class="discounted-price" style="font-size: 18px;">${{ $product->discounted_price }}</span>
                                <!-- Tampilkan category_name jika ada diskon -->
                            @else
                                <span class="price" style="font-size: 18px;">${{ $product->price }}</span><br>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No products found</p>
        @endif
    </div>
</div>

<script>
    function addToWishlist(productId) {
        // Ambil customer_id dari session atau dari Auth jika tersedia
        let customerId = '{{ Auth::guard("customers")->id() }}';

        // Pastikan customerId dan productId tidak kosong
        if (customerId && productId) {
            // Setel nilai product_id_input dan customer_id_input
            document.getElementById('product_id_input').value = productId;
            document.getElementById('customer_id_input').value = customerId;
            
            // Kirim formulir
            document.getElementById('addToWishlistForm').submit();
        } else {
            // Handle jika customerId atau productId kosong
            console.error('customerId or productId is empty');
        }
    }
</script>


</div>


        <div class="col-lg-3">
            <div class="left_sidebar_area">
                
            <aside class="left_widgets p_filter_widgets product_categories">
    <div class="l_w_title">
        <h3>Product Categories</h3>
    </div>
    <div class="widgets_inner">
        <ul class="list">
            <li>
                <a href="{{ route('category.index') }}" class="{{ !$categoryId && !$discountCategoryId ? 'active' : '' }}">All Products</a>
            </li>
            @foreach($categories as $cat)
                <li>
                    <a href="{{ route('category.index', ['category_id' => $cat->id]) }}" class="{{ $cat->id == $categoryId ? 'active' : '' }}">{{ $cat->category_name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>

<aside class="left_widgets p_filter_widgets discount_categories">
    <div class="l_w_title">
        <h3>Discount Categories</h3>
    </div>
    <div class="widgets_inner">
        <ul class="list">
            @foreach($discountCategories as $discountCat)
                <li>
                    <a href="{{ route('category.index', ['discount_category_id' => $discountCat->id]) }}" class="{{ $discountCat->id == $discountCategoryId ? 'active' : '' }}">{{ $discountCat->category_name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
         
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</section>


    <!--================End Category Product Area =================-->

    <!--================ start footer Area  =================-->
    <footer class="footer-area section_gap">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-6 single-footer-widget">
            <h4>Top Products</h4>
            <ul>
              <li><a href="#">Managed Website</a></li>
              <li><a href="#">Manage Reputation</a></li>
              <li><a href="#">Power Tools</a></li>
              <li><a href="#">Marketing Service</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 single-footer-widget">
            <h4>Quick Links</h4>
            <ul>
              <li><a href="#">Jobs</a></li>
              <li><a href="#">Brand Assets</a></li>
              <li><a href="#">Investor Relations</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 single-footer-widget">
            <h4>Features</h4>
            <ul>
              <li><a href="#">Jobs</a></li>
              <li><a href="#">Brand Assets</a></li>
              <li><a href="#">Investor Relations</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 single-footer-widget">
            <h4>Resources</h4>
            <ul>
              <li><a href="#">Guides</a></li>
              <li><a href="#">Research</a></li>
              <li><a href="#">Experts</a></li>
              <li><a href="#">Agencies</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6 single-footer-widget">
            <h4>Newsletter</h4>
            <p>You can trust us. we only send promo offers,</p>
            <div class="form-wrap" id="mc_embed_signup">
              <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                method="get" class="form-inline">
                <input class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Your Email Address '" required="" type="email">
                <button class="click-btn btn btn-default">Subscribe</button>
                <div style="position: absolute; left: -5000px;">
                  <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                </div>
  
                <div class="info"></div>
              </form>
            </div>
          </div>
        </div>
        <div class="footer-bottom row align-items-center">
          <p class="footer-text m-0 col-lg-8 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          <div class="col-lg-4 col-md-12 footer-social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-dribbble"></i></a>
            <a href="#"><i class="fa fa-behance"></i></a>
          </div>
        </div>
      </div>
    </footer>
    <!--================ End footer Area  =================-->

<!-- <script>
    // Redirect to login page after 10 seconds of inactivity
let timeout = setTimeout(function() {
    window.location.href = '/';
}, 60000); // 10 seconds in milliseconds

// Reset the timer on any user activity
document.addEventListener('mousemove', function() {
    clearTimeout(timeout);
    timeout = setTimeout(function() {
        window.location.href = '/';
    }, 60000); // 10 seconds in milliseconds
});

// Reset the timer on any keyboard activity
document.addEventListener('keypress', function() {
    clearTimeout(timeout);
    timeout = setTimeout(function() {
        window.location.href = '/';
    }, 60000); // 10 seconds in milliseconds
});
  </script> -->    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@parent
@if(Auth::guard('customers')->check() && !session('loginPopupDisplayed'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tampilkan SweetAlert hanya jika pengguna berhasil login dan pop-up belum ditampilkan sebelumnya
            Swal.fire({
                icon: 'success',
                title: 'Login Successful!',
                text: 'Welcome back, {{ Auth::guard("customers")->user()->name }}!',
                showConfirmButton: false,
                timer: 1500 // Durasi pop-up dalam milidetik
            });
        });
    </script>
    <?php session(['loginPopupDisplayed' => true]); ?>

@endif
@endsection
