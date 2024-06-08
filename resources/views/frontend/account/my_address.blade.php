@extends('frontend.landingpage.main')
@section('title', 'Account')
@section('page', 'Account')
@section('header')
    @include('frontend.landingpage.header')
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="row g-4">
                    <div class="row g-4">
                        @include('frontend.account.layout.sidebar')

                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>My Address</h4>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="{{ route('updateAddress') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-6">
                                                        <div class="form-item w-100">
                                                            <label class="form-label my-3">First Name<sup>*</sup></label>
                                                            <input type="text" class="form-control" name="first_name"
                                                            value="{{ $customer->first_name ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-6">
                                                        <div class="form-item w-100">
                                                            <label class="form-label my-3">Last Name<sup>*</sup></label>
                                                            <input type="text" class="form-control" name="last_name"
                                                                value="{{ !empty($customer) ? $customer->last_name : ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-item">
                                                    <label class="form-label my-3">Email<sup>*</sup></label>
                                                    <input type="text" class="form-control" name="email" value="{{ !empty($customer) ? $customer->email : ''}}">
                                                </div>
                                                <div class="form-item">
                                                    <label class="form-label my-3">Phone Number<sup>*</sup></label>
                                                    <input type="text" class="form-control" name="phone_number"
                                                        value="{{ !empty($customer) ? $customer->phone_number : ''}}">
                                                </div>
                                                <div class="form-item">
                                                    <label class="form-label my-3">Address <sup>*</sup></label>
                                                    <textarea class="form-control" placeholder="Address" name="address"> {{ !empty($customer) ? $customer->address : ''}}</textarea>
                                                </div>
                                                <div class="form-item">
                                                    <label class="form-label my-3">Town/City<sup>*</sup></label>
                                                    <input type="text" class="form-control" name="city" value="{{ !empty($customer) ? $customer->city : ''}}">
                                                </div>
                                                <div class="form-item">
                                                    <label class="form-label my-3">State<sup>*</sup></label>
                                                    <input type="text" class="form-control" name="state" value="{{ !empty($customer) ? $customer->state : '' }}">
                                                </div>
                                                <div class="form-item">
                                                    <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                                                    <input type="text" class="form-control" name="zip" value="{{ !empty($customer) ? $customer->zip : '' }}">
                                                </div>
                                                <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                                    <button type="submit"
                                                        class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Save My
                                                        Address</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection