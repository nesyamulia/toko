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
                                            <h4>My Orders</h4>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>ORDER</th>
                                                        <th>DATE</th>
                                                        <th>STATUS</th>
                                                        <th>TOTAL</th>
                                                        <th></th>
                                                    </tr>
                                                    @foreach ($orders as $order)
                                                    <tr>
                                                        <td><a class="account-order-id" href="javascript:void(0)">{{ !empty($order) ? $order->order_no : ''}}</a></td>
                                                        <td>{{ !empty($order) ? $order->order_date : ''}}</td>
                                                        <td>{{ !empty($order) ? $order->status : ''}}</td>
                                                        <td>Rp {{ !empty($order) ? $order->total_amount : ''}}</td>
                                                        <td><a href="{{ route('myOrderDetail', $order->id)}}"
                                                                class="btn btn-secondary btn-primary-hover"><span>View</span></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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