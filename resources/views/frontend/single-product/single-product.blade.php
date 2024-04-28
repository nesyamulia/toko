@extends('frontend.landingpage.main')
@section('title', 'Product Detail Page')
@section('page', 'Product Detail Page')
@section('header')
    @include('frontend.landingpage.header')

<style>
  .tab-content p {
        word-wrap: break-word; /* Untuk lompatan kata pada spasi */
        overflow-wrap: break-word; /* Juga untuk lompatan kata pada spasi */
    }
</style>

    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Product Details</h2>
              <p>Explore the detailed information about our products.</p>
            </div>
            <div class="page_link">
              <a href="/home-page">Home</a>
              <a href="/category">Product Category</a>
              <a href="/single-product">Product Details</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

   <!--================Single Product Area =================-->
   <div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="s_product_img">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      @if(count($imageUrls) > 0)
                          @for($i = 1; $i <= 5; $i++)
                              @if(!empty($product->{'image'.$i.'_url'}))
                                  <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i - 1 }}" class="{{ $i == 1 ? 'active' : '' }}">
                                      <img src="{{ asset($product->{'image'.$i.'_url'}) }}" alt="{{ $product->product_name }}" style="max-width: 60px; height: auto; cursor: pointer; border: 2px solid transparent;">
                                  </li>
                              @endif
                          @endfor
                      @endif
                  </ol>

                  <div class="carousel-inner">
                      @if(count($imageUrls) > 0)
                          @for($i = 1; $i <= 5; $i++)
                              @if(!empty($product->{'image'.$i.'_url'}))
                                  <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                                      <img class="d-block w-100" src="{{ asset($product->{'image'.$i.'_url'}) }}" alt="{{ $product->product_name }}" style="max-height: 400px; object-fit: contain;">
                                  </div>
                              @endif
                          @endfor
                      @endif
                  </div>
                    </div>
                </div>
            </div>

            
<div class="col-lg-6">
    <div class="s_product_text float-right">
        <h3>{{ $product->product_name }}</h3>
        @if ($product->discount && isset($product->discounted_price))
            <span>Discount {{ $product->discount_category_name }}</span><br>
            <span class="badge badge-success">{{ $product->discount->percentage }}% Off</span>
            <del>${{ $product->price }}</del>
            <h2>${{ $product->discounted_price }}</h2>
        @else
            <h2>${{ $product->price }}</h2>
        @endif
        <ul class="list">
            <li>
                <span>Category</span> : {{ $product->category->category_name }}
            </li>
            <li>    
                <span>Availability</span> : {{ $product->stok_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
            </li>
            @if ($product->stok_quantity > 0)
                <li>
                    <span>Remaining Stock</span> : {{ $product->stok_quantity }}
                </li>
            @endif
        </ul>



                    <div class="product_count mt-4">
                        <label for="qty">Quantity:</label>
                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                            <i class="lnr lnr-chevron-up"></i>
                        </button>
                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                            <i class="lnr lnr-chevron-down"></i>
                        </button>
                    </div>
                    <div class="card_area">
                        <a class="main_btn" href="#">Add to Cart</a>
                        <a class="icon_btn" href="#">
                            <i class="lnr lnr lnr-diamond"></i>
                        </a>
                        <a class="icon_btn" href="#">
                            <i class="lnr lnr lnr-heart"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a
              class="nav-link"
              id="home-tab"
              data-toggle="tab"
              href="#home"
              role="tab"
              aria-controls="home"
              aria-selected="true"
              >Description</a
            >
          </li>
          
          <li class="nav-item">
            <a
              class="nav-link active"
              id="review-tab"
              data-toggle="tab"
              href="#review"
              role="tab"
              aria-controls="review"
              aria-selected="false"
              >Reviews</a
            >
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div
            class="tab-pane fade"
            id="home"
            role="tabpanel"
            aria-labelledby="home-tab"
          >
            <p>{{ $product->description }}</p>
          </div>
          <div
            class="tab-pane fade"
            id="profile"
            role="tabpanel"
            aria-labelledby="profile-tab"
          >
          </div>
          <div
            class="tab-pane fade"
            id="contact"
            role="tabpanel"
            aria-labelledby="contact-tab"
          >
          </div>
          <div
            class="tab-pane fade show active"
            id="review"
            role="tabpanel"
            aria-labelledby="review-tab"
          >
            <div class="row">
              <div class="col-lg-6">
                <div class="row total_rate">
                  <div class="col-6">
                    <div class="box_total">
                      <h5>Overall</h5>
                      <h4>4.0</h4>
                      <h6>(03 Reviews)</h6>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="rating_list">
                      <h3>Based on 3 Reviews</h3>
                      <ul class="list">
                        <li>
                          <a href="#"
                            >5 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >4 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >3 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >2 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >1 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="review_list">
    <!-- Periksa apakah ada ulasan yang tersedia -->
    @if($product->reviews && $product->reviews->isNotEmpty())
        <!-- Tampilkan ulasan produk yang sudah ada -->
        @foreach($product->reviews as $review)
        <div class="review_item">
            <div class="media">
                <!-- Tampilkan gambar profil pelanggan -->
      
                <div class="media-body">
                    <!-- Tampilkan nama pengguna -->
                    <h4>{{ $review->customer->name }}</h4>
                    <!-- Tampilkan rating ulasan -->
                    @for($i = 0; $i < $review->rating; $i++)
                        <i class="fa fa-star"></i>
                    @endfor
                    <!-- Tampilkan teks ulasan -->
                    <p>{{ $review->comment }}</p>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <p>No reviews available.</p>
    @endif
</div>


<div class="col-lg-8"> <!-- Menggunakan offset untuk menggeser kolom ke sebelah kanan -->
    <div class="review_box">
        <h4>Add a Review</h4>
        <p>Your Rating:</p>
        <ul class="list">
            <li><a href="#"><i class="fa fa-star" data-rating="1"></i></a></li>
            <li><a href="#"><i class="fa fa-star" data-rating="2"></i></a></li>
            <li><a href="#"><i class="fa fa-star" data-rating="3"></i></a></li>
            <li><a href="#"><i class="fa fa-star" data-rating="4"></i></a></li>
            <li><a href="#"><i class="fa fa-star" data-rating="5"></i></a></li>
        </ul>
        <p>Outstanding</p>
        <form class="row contact_form" action="{{ route('single-product.store') }}" method="post" id="contactForm" novalidate="novalidate">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="number" class="form-control" id="rating" name="rating" placeholder="Rating (1-5)" min="1" max="5" required />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Review" required></textarea>
                </div>
            </div>
            <div class="col-md-12 text-right">
                <button type="submit" class="btn submit_btn">Submit Now</button>
            </div>
        </form>
    </div>
</div>


            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Product Description Area =================-->

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
    // Set waktu timeout (dalam milidetik)
    const timeoutDuration = 60000; // 10 detik dalam milidetik

    // Fungsi untuk logout
    function logoutUser() {
        const form = document.getElementById('logout-form');
        if (form) {
            form.submit(); // Submit form logout
        }
    }

    // Reset timer setelah aktivitas pengguna
    function resetTimer() {
        clearTimeout(logoutTimer);
        logoutTimer = setTimeout(logoutUser, timeoutDuration);
    }

    // Inisialisasi timer
    let logoutTimer = setTimeout(logoutUser, timeoutDuration);

    // Reset timer ketika ada aktivitas mouse
    document.addEventListener('mousemove', resetTimer);

    // Reset timer ketika ada aktivitas keyboard
    document.addEventListener('keypress', resetTimer);
</script> -->
@endsection