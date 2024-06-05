@extends('frontend.landingpage.main')
@section('title', 'Account')
@section('page', 'Account')
@section('header')
    @include('frontend.landingpage.header')
    
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Account Page Start -->
            <div class="account-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            @include('frontend.account.layout.sidebar')
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, aspernatur.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Account Page End -->
        </div>
    </div>
@endSection
