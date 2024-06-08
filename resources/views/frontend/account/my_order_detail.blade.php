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
                                            <div class="container-fluid">

                                                <div class="container">
                                                  <!-- Title -->
                                                  <div class="d-flex justify-content-between align-items-center py-3">
                                                    <h2 class="h5 mb-0"><a href="#" class="text-muted"></a>Order {{ $order->order_no }} </h2>
                                                  </div>
                                                
                                                  <!-- Main content -->
                                                  <div class="row">
                                                    <div class="col-lg-8">
                                                      <!-- Details -->
                                                      <div class="card mb-4">
                                                        <div class="card-body">
                                                          <div class="mb-3 d-flex justify-content-between">
                                                            <div>
                                                              <span class="me-3">{{ $order->order_date}}</span>
                                                              <span class="badge rounded-pill bg-info">SHIPPING</span>
                                                            </div>
                                                           
                                                          </div>
                                                          <table class="table table-borderless">
                                                            <tbody>
                                                                @foreach ($orderDetail as $item)   
                                                                {{-- @dd($item->product->image1_url); --}}
                                                                <tr>
                                                                  <td>
                                                                    <div class="d-flex mb-2">
                                                                      <div class="flex-shrink-0">
                                                                        <img src="{{ asset($item->product->image1_url) }}" alt="{{ $item->product_name }}" width="35" class="img-fluid">
                                                                      </div>
                                                                      <div class="flex-lg-grow-1 ms-3">
                                                                        <h6 class="small mb-0"><a href="#" class="text-reset">{{ $item->product_name }}</a></h6>
                                                                      </div>
                                                                    </div>
                                                                  </td>
                                                                  <td>{{$item->quantity}}</td>
                                                                  <td class="text-end">Rp {{number_format($item->price, 0, ',', '.')}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                              <tr>
                                                                <td colspan="2">Subtotal</td>
                                                                <td class="text-end">Rp {{number_format($order->subtotal, 0, ',', '.')}}</td>
                                                              </tr>
                                                              <tr>
                                                                <td colspan="2">Discount (Code: NEWYEAR)</td>
                                                                <td class="text-danger text-end">-Rp {{number_format($order->discount, 0, ',', '.')}}</td>
                                                              </tr>
                                                              <tr class="fw-bold">
                                                                <td colspan="2">TOTAL</td>
                                                                <td class="text-end">Rp {{number_format($order->total_amount, 0, ',', '.')}}</td>
                                                              </tr>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                      </div>
                                                      <!-- Payment -->
                                                      <div class="card mb-4">
                                                        <div class="card-body">
                                                          <div class="row">
                                                            <div class="col-lg-6">
                                                              <h3 class="h6">Payment Method</h3>
                                                              <p>Visa -1234 <br>
                                                              Total: $169,98 <span class="badge bg-success rounded-pill">PAID</span></p>
                                                            </div>
                                                            <div class="col-lg-6">
                                                              <h3 class="h6">Billing address</h3>
                                                              <address>
                                                                <strong>John Doe</strong><br>
                                                                1355 Market St, Suite 900<br>
                                                                San Francisco, CA 94103<br>
                                                                <abbr title="Phone">P:</abbr> (123) 456-7890
                                                              </address>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                      <!-- Customer Notes -->
                                                      <div class="card mb-4">
                                                        <div class="card-body">
                                                          <h3 class="h6">Customer Notes</h3>
                                                          <p>Sed enim, faucibus litora velit vestibulum habitasse. Cras lobortis cum sem aliquet mauris rutrum. Sollicitudin. Morbi, sem tellus vestibulum porttitor.</p>
                                                        </div>
                                                      </div>
                                                      <div class="card mb-4">
                                                        <!-- Shipping information -->
                                                        <div class="card-body">
                                                          <h3 class="h6">Shipping Information</h3>
                                                          <strong>FedEx</strong>
                                                          <span><a href="#" class="text-decoration-underline" target="_blank">FF1234567890</a> <i class="bi bi-box-arrow-up-right"></i> </span>
                                                          <hr>
                                                          <h3 class="h6">Address</h3>
                                                          <address>
                                                            <strong>John Doe</strong><br>
                                                            1355 Market St, Suite 900<br>
                                                            San Francisco, CA 94103<br>
                                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                                          </address>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                  </div>
