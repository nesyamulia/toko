@extends('frontend.landingpage.main')
@section('title', 'Checkout')
@section('page', 'Checkout')
@section('header')
    @include('frontend.landingpage.header')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <form action="{{ route('saveCustomer') }}" method="POST">
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
                                        value="{{ $customer->last_name ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email<sup>*</sup></label>
                            <input type="text" class="form-control" name="email" value="{{ $customer->email ?? '' }}">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Phone Number<sup>*</sup></label>
                            <input type="text" class="form-control" name="phone_number"
                                value="{{ $customer->phone_number ?? '' }}">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <textarea class="form-control" placeholder="Address" name="address"> {{ $customer->address ?? '' }}</textarea>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" class="form-control" name="city" value="{{ $customer->city ?? '' }}">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">State<sup>*</sup></label>
                            <input type="text" class="form-control" name="state" value="{{ $customer->state ?? '' }}">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" class="form-control" name="zip" value="{{ $customer->zip ?? '' }}">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Order Notes</label>
                            <textarea class="form-control" name="order_notes" rows="4"> {{ $customer->order_notes ?? '' }}</textarea>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Save Customer
                                Address</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="mt-5">
                        @if (session('discountResponse'))
                            @php
                                $response = session('discountResponse');
                            @endphp
                            @if ($response['status'])
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {!! $response['discountString'] !!}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @else
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {!! $response['message'] !!}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        @endif
                        <form action="{{ route('applyDiscount') }}" method="POST">
                        </form>
                        <form action="{{ route('applyDiscount') }}" method="POST">
                            @csrf
                            <input type="text" name="code" class="border-0 border-bottom rounded me-5 py-3 mb-4"
                                placeholder="Coupon Code">
                            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="submit">Apply
                                Coupon</button>
                        </form>
                    </div>
                    <form action="{{ route('processCheckout') }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::content() as $item)
                                        <tr>

                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="{{ asset($item->options->image) }}"
                                                        class="img-fluid rounded-circle" style="width: 60px;"
                                                        alt="">
                                                </div>
                                            </th>
                                            <td class="py-5">{{ $item->name }}</td>
                                            <td class="py-5">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td class="py-5">{{ $item->qty }}</td>
                                            <td class="py-5">
                                                Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (session('discountResponse') && session('discountResponse')['status'])
                                        @php
                                            $discount = session('discountResponse')['discount'];
                                            $grandTotal = session('discountResponse')['grandTotal'];
                                        @endphp
                                        <tr>
                                            <th scope="row"></th>
                                            <td class="py-3">
                                                <p class="mb-0 text-dark text-uppercase py-3">SUBTOTAL</p>
                                            </td>
                                            <td class="py-3"></td>
                                            <td class="py-3" colspan="2">
                                                <p class="mb-0 text-dark text-uppercase py-3">Rp
                                                    {{ Cart::subtotal(0, '', '.') }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td class="py-3">
                                                <p class="mb-0 text-dark text-uppercase py-3">DISCOUNT</p>
                                            </td>
                                            <td class="py-3"></td>
                                            <td class="py-3" colspan="2">
                                                <p class="mb-0 text-dark text-uppercase py-3">- Rp
                                                    {{ number_format($discount, 0, ',', '.') }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td class="py-3">
                                                <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                            </td>
                                            <td class="py-3"></td>
                                            <td class="py-3" colspan="2">
                                                <p class="mb-0 text-dark text-uppercase py-3">Rp
                                                    {{ number_format($grandTotal, 0, ',', '.') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th scope="row"></th>
                                            <td class="py-3">
                                                <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                            </td>
                                            <td class="py-3"></td>
                                            <td class="py-3" colspan="2">
                                                <p class="mb-0 text-dark text-uppercase py-3">Rp {{ Cart::subtotal() }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Transfer-1"
                                        name="payment_method" value="transfer" onclick="toggleBankTransferInput()">
                                    <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                                </div>
                            </div>
                            <div class="col-12" id="bank-transfer-details" style="display:none;">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Bank Name<sup>*</sup></label>
                                    <select class="form-control" name="bank_name">
                                        <option value="">Select Bank</option>
                                        <option value="BCA">BCA</option>
                                        <option value="BRI">BRI</option>
                                        <option value="BSI">BSI</option>
                                        <option value="Mandiri">Mandiri</option>
                                    </select>
                                </div>
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Account Number<sup>*</sup></label>
                                    <input type="text" class="form-control" name="card_number">
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Delivery-1"
                                        name="payment_method" value="cod" onclick="toggleBankTransferInput()">
                                    <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place
                                Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout Page End -->

    <script>
        function toggleBankTransferInput() {
            const bankTransferDetails = document.getElementById('bank-transfer-details');
            const transferRadio = document.getElementById('Transfer-1');

            if (transferRadio.checked) {
                bankTransferDetails.style.display = 'block';
            } else {
                bankTransferDetails.style.display = 'none';
            }
        }

        // Panggil fungsi saat halaman dimuat untuk memastikan input sesuai dengan status awal
        document.addEventListener('DOMContentLoaded', (event) => {
            toggleBankTransferInput();
        });
    </script>
@endsection
