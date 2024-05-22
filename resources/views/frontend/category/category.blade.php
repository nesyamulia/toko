@extends('frontend.landingpage.main')
@section('title', 'Category')
@section('page', 'Category')
@section('header')
    @include('frontend.landingpage.header')

<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <!-- <h1 class="mb-4">Fresh fruits shop</h1> -->
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">            
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                      <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <!-- Tautan untuk kategori vegetables -->
                                                <a href="{{ route('category.index', ['category_id' => '1']) }}" class="{{ request()->get('category_id') == '1' ? 'active' : '' }}">
                                                    <i class="fas fa-apple-alt me-2"></i>Vegetables
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <!-- Tautan untuk kategori fruits -->
                                                <a href="{{ route('category.index', ['category_id' => '2']) }}" class="{{ request()->get('category_id') == '2' ? 'active' : '' }}">
                                                    <i class="fas fa-apple-alt me-2"></i>Fruits
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>                        
                        </div>
                    </div> 
                <div class="col-lg-9">
                <div class="row g-4 justify-content-center">
    @foreach($products as $product)
    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="rounded position-relative fruite-item">
            <a href="{{ route('single-product', ['id' => $product->id]) }}"> <!-- Tautan ke halaman single-product -->
                <div class="fruite-img">
                    <!-- Ubah img src dengan URL gambar dari model Product jika ada -->
                    <img src="{{ $product->image1_url }}" class="img-fluid w-100 h-100 rounded-top" alt="">
                </div>
                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                    <!-- Tampilkan category_name dari model ProductCategory -->
                    {{ $product->category->category_name }}
                </div>
                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                    <!-- Tampilkan product_name dan price dari model Product -->
                    <h4>{{ $product->product_name }}</h4>
                    <div class="d-flex justify-content-between flex-lg-wrap">
                        <p class="text-dark fs-5 fw-bold mb-0">Rp{{ $product->price }} / 500gr</p>
                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary">
                            <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                        </a>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>

</div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->
<!-- active -->
<style>
    .active {
    font-weight: bold;
    color: #ffb524; /* Ganti dengan warna yang Anda inginkan */
}

</style>
<!-- end active -->
@endsection
