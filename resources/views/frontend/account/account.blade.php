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
                                            <h4>Your Profile</h4>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="{{ route('updateAccount') }}" class="form" method="POST">
                                                @csrf
                                                <div class="form-group row mb-3">
                                                    <label for="name" class="col-4 col-form-label">Name*</label>
                                                    <div class="col-8">
                                                        <input type="text" name="name" value="{{ !empty($user) ? $user->name : ''}}" placeholder="Name"
                                                            class="form-control here" required="required" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for="email" class="col-4 col-form-label">Email*</label>
                                                    <div class="col-8">
                                                        <input type="email" name="email" value="{{ !empty($user) ? $user->email : ''}}" placeholder="Email"
                                                            class="form-control here" required="required" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <div class="offset-4 col-8">
                                                        <button name="submit" type="submit"
                                                            class="btn btn-primary">Update My Profile</button>
                                                    </div>
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
@endSection
