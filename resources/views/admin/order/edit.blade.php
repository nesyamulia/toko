@extends('admin.dashboard.main')
@section('title', 'Edit Order')
@section('sidenav')
    @include('admin.dashboard.sidenav')
@endsection
@section('page', 'Edit Order')
@section('nav')
    @include('admin.dashboard.nav')

    <style>
        .border-contrast {
            transition: border-color 0.3s ease; 
            border: 1px solid #ced4da; 
            width: 100%; 
        }

        .border-contrast:focus-within {
            border-color: #ff69b4; 
        }

        .form-label {
            font-weight: bold;
            margin-top: 20px;
        }

        .card {
            margin-top: 30px;
            margin-left: 150px;
            width: 70%;
        }
        
        .col-3 {
            margin-top: 30px;
        }

        .error-message {
            color: red;
            font-size: 12px;
        }
    </style>

<div class="card mb-4">
    <div class="card-border-1 ms-3 me-3">
    <form action="{{ route('order.update', $order->id) }}" method="post" id="OrderForm">
        @csrf
        @method('PUT')
        <div class="mb-3 ms-3 me-3">
            <label for="order_no" class="form-label">Order Number</label>
            <div class="border-contrast p-1 rounded"> 
                <input type="text" class="form-control text-white bg-dark border-0" id="order_no" name="order_no" value="{{ $order->order_no }}" class="text-dark" disabled>
            </div>
            @error('order_no')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="first_name" class="form-label">Name</label>
            <div class="border-contrast p-1 rounded"> 
                <input type="text" class="form-control text-white bg-dark border-0" id="first_name" name="first_name" value="{{ $order->first_name . ' ' . $order->last_name }}" class="text-dark" disabled>
            </div>
            @error('first_name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="order_date" class="form-label">Order Date</label>
            <div class="border-contrast p-1 rounded"> 
                <input type="datetime-local" class="form-control text-white  bg-dark border-0" id="order_date" name="order_date" value="{{ $order->order_date }}" class="text-dark" disabled>
            </div>
            @error('order_date')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="product" class="form-label">Product</label>
            <div class="border-contrast p-1 rounded"> 
                @foreach ($order->items as $item)
                <input type="text" class="form-control text-white  bg-dark border-0" id="product" name="product" value=" {{ $item->product->product_name }} x {{ $item->quantity }}" class="text-dark" disabled>
                @endforeach
            </div>
            @error('product')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <div class="border-contrast p-1 rounded"> 
                <input type="number" class="form-control text-white bg-dark border-0" id="total_amount" name="total_amount" value="{{ $order->total_amount }}" class="text-dark" disabled>
            </div>
            @error('total_amount')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <div class="border-contrast p-1 rounded"> 
                <input type="text" class="form-control text-white bg-dark border-0" id="payment_method" name="payment_method" value="{{ $order->payment_method }}" class="text-dark" disabled>
            </div>
            @error('payment_method')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="payment_status" class="form-label">Payment Status</label>
            <div class="border-contrast p-1 rounded"> 
                <select class="form-select text-white bg-dark border-0" id="payment_status" name="payment_status">
                    <option selected value="default">Select Payment Status</option> 
                    <option value="not paid" {{ $order->payment_status == 'not paid' ? 'selected' : '' }}>Not Paid</option> 
                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option> 
                </select>
            </div>
            @error('payment_status')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="status" class="form-label">Status</label>
            <div class="border-contrast p-1 rounded"> 
                <select class="form-select text-white bg-dark border-0" id="status" name="status">
                <option selected value="default">Select Status</option> 
                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option> 
                <option value="shipped" {{ $order->payment_status == 'shipped' ? 'selected' : '' }}>Shipped</option> 
                <option value="delivered" {{ $order->payment_status == 'delivered' ? 'selected' : '' }}>Delivered</option> 
                <option value="cancelled" {{ $order->payment_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option> 
                </select>
            </div>
            @error('status')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="delivered_date" class="form-label">Delivery Date</label>
            <div class="border-contrast p-1 rounded"> 
                <input type="datetime-local" class="form-control text-white bg-dark border-0" id="delivered_date" name="delivered_date" value="{{ $order->delivered_date }}" class="text-dark">
            </div>
            @error('delivered_date')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="row ms-3 me-3 justify-content-end">
            <div class="col-3">
                <a href="{{ route('order.index') }}" class="btn bg-gradient-secondary w-100">Cancel</a>
            </div>
            <div class="col-3">
                <button type="submit" id="save" class="btn bg-gradient-primary w-100">Update</button>
            </div>
        </div>
    </form>
</div>
</div>

<footer class="footer pt-5">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    © <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Nesya Mulia</a>
                    for a better web.
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script>
    const btnSave = document.getElementById("save");
    const form = document.getElementById("OrderForm");

    function simpan() {
        let ps = document.getElementById("payment_status").value;
        let s = document.getElementById("status").value;

        // Membuat array untuk menyimpan pesan kesalahan
        let errorMessages = [];

        // Memeriksa input dan menambahkan pesan kesalahan ke array jika diperlukan
        if (ps.trim() === "") {
            errorMessages.push("Payment Status is required");
        }

        if (s.trim() === "") {
            errorMessages.push("Status is required");
        }



        // Menampilkan pesan kesalahan jika ada
        if (errorMessages.length > 0) {
            // Jika terdapat pesan kesalahan, tampilkan dalam SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                html: errorMessages.join('<br>') // Menampilkan pesan kesalahan dalam format yang terbaca
            });
        } else {
            // Jika tidak ada pesan kesalahan, tampilkan pesan konfirmasi
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to update this order?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengklik 'Yes', submit form untuk mengupdate order
                    form.submit();
                }
            });
        }
    }

    btnSave.onclick = function (event) {
        event.preventDefault(); // Menghentikan perilaku default dari tombol submit
        simpan();
    };
</script>

@endsection

