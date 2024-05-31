@extends('admin.dashboard.main')
@section('title', 'Edit Discount')
@section('sidenav')
    @include('admin.dashboard.sidenav')
@endsection
@section('page', 'Edit Discount')
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
    <form action="{{ route('discount.update', $discounts->id) }}" method="post" id="DiscountForm" enctype="multipart/form-data">
        @csrf 
        @method("put")
        <div class="mb-3 ms-3 me-3">
            <label for="code" class="form-label">Code</label>
            <div class="border-contrast p-1 rounded"> 
                <input type="text" class="form-control text-white border-0" id="code" name="code"  class="text-dark" placeholder="Code" value="{{ $discounts->code ?? ''}}">
            </div>
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="name" class="form-label">Name</label>
            <div class="border-contrast p-1 rounded"> 
                <input type="text" class="form-control text-white border-0" id="name" name="name" class="text-dark" placeholder="Name" value="{{ $discounts->name ?? ''}}">
            </div>
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="type" class="form-label">Type</label>
            <div class="border-contrast p-1 rounded"> 
                <select class="form-select text-white border-0" id="type" name="type">
                    <option selected value="">Select Type</option>
                    <option value="percentage" {{ $discounts->type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                    <option value="fixed" {{ $discounts->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                </select>
            </div>
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="discount_amount" class="form-label">Discount Amount</label>
            <div class="border-contrast p-1 rounded"> 
                <input type="text" class="form-control text-white border-0" id="discount_amount" name="discount_amount"  class="text-dark" placeholder="Discount Amount" value="{{ $discounts->discount_amount ?? ''}}">
            </div>
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="start_date" class="form-label">Start Date</label>
            <div class="border-contrast p-1 rounded"> 
                <input type="datetime-local" class="form-control text-white border-0" id="start_date" name="start_date" value="{{ $discounts->start_date ?? ''}}">
            </div>
            @error('start_date')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="end_date" class="form-label">End Date</label>
            <div class="border-contrast p-1 rounded"> 
                <input type="datetime-local" class="form-control text-white border-0" id="end_date" name="end_date"  value="{{ $discounts->end_date ?? ''}}">
            </div>
            @error('end_date')
                <div class="error-message">{{ $message }}</div>
            @enderror
            @error('percentage')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 ms-3 me-3">
            <label for="status" class="form-label">Status</label>
            <div class="border-contrast p-1 rounded"> 
                <select class="form-select text-white border-0" id="status" name="status">
                    <option selected value="">Select Status</option>
                    <option value="1" {{ $discounts->status == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $discounts->status == '0' ? 'selected' : '' }}>InActive</option>
                </select>
            </div>
        </div>
        <div class="row ms-3 me-3 justify-content-end">
            <div class="col-3">
                <a href="{{ route('discount.index') }}" class="btn bg-gradient-secondary w-100">Cancel</a>
            </div>
            <div class="col-3">
                <button type="submit" id="save" class="btn bg-gradient-primary w-100">Create</button>
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
    const form = document.getElementById("DiscountForm");

    function simpan() {
        let code = document.getElementById("code").value;
        let name= document.getElementById("name").value;
        let type= document.getElementById("type").value;
        let discount_amount= document.getElementById("discount_amount").value;
        let start_date = document.getElementById("start_date").value;
        let end_date = document.getElementById("end_date").value;
        let status = document.getElementById("status").value;

        // Membuat array untuk menyimpan pesan kesalahan
        let errorMessages = [];

        // Memeriksa input dan menambahkan pesan kesalahan ke array jika diperlukan
                if (code.trim() === "") {
            errorMessages.push("Code is required");
        }

        if (name.trim() === "") {
            errorMessages.push("Name is required");
        }
        if (type.trim() === "") {
            errorMessages.push("Type is required");
        }
        if (discount_amount.trim() === "") {
            errorMessages.push("Discount Amount is required");
        }

        if (start_date.trim() === "") {
            errorMessages.push("Start Date is required");
        }

        if (end_date.trim() === "") {
            errorMessages.push("End Date is required");
        }

        if (status.trim() === "") {
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
                text: 'Do you want to create this product review?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, create it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengklik 'Yes', submit form untuk membuat ulasan produk
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

