@extends('admin.dashboard.main')
@section('title', 'Edit User')
@section('sidenav')
    @include('admin.dashboard.sidenav')
@endsection
@section('page', 'Edit User')
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
            <form action="{{ route('user.update', $user->id) }}" method="post" id="userFormEdit" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 ms-3 me-3">
                    <label for="name" class="form-label">Name</label>
                    <div class="border-contrast p-1 rounded"> 
                        <input type="text" class="form-control text-white border-0" id="name" name="name" placeholder=" Name" aria-label="Name" value="{{ $user->name }}" class="text-dark">
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 ms-3 me-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="border-contrast p-1 rounded"> 
                        <input type="email" class="form-control text-white border-0" id="email" name="email" placeholder=" Email" aria-label="Email" value="{{ $user->email }}" class="text-dark">
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 ms-3 me-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="border-contrast p-1 rounded"> 
                        <input type="password" class="form-control text-white border-0" id="password" name="password" placeholder=" Password" aria-label="Password">
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 ms-3 me-3">
                    <label for="roles" class="form-label">Roles</label>
                    <div class="border-contrast p-1 rounded"> 
                        <select class="form-control text-white border-0" id="roles" name="roles" aria-label="Roles">
                            <option value="admin" {{ $user->roles === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="owner" {{ $user->roles === 'owner' ? 'selected' : '' }}>Owner</option>
                        </select>
                    </div>
                    @error('roles')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 ms-3 me-3">
                    <label for="aktif" class="form-label">Status</label>
                    <div class="border-contrast p-1 rounded"> 
                        <select class="form-control text-white border-0" id="aktif" name="aktif" aria-label="Aktif">
                            <option value="1" {{ $user->aktif === 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $user->aktif === 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    @error('aktif')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row ms-3 me-3 justify-content-end">
                    <div class="col-3">
                        <a href="{{ route('user.index') }}" class="btn bg-gradient-secondary w-100">Cancel</a>
                    </div>
                    <div class="col-3">
                        <button type="button" id="save" class="btn bg-gradient-primary w-100">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tutup Tabel -->

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
    const form = document.getElementById("userFormEdit");

    function simpan() {
        let name = document.getElementById("name").value;
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let roles = document.getElementById("roles").value;
        let aktif = document.getElementById("aktif").value;

        // Membuat array untuk menyimpan pesan kesalahan
        let errorMessages = [];

        // Memeriksa setiap input dan menambahkan pesan kesalahan ke array jika diperlukan
        if (name.trim() === "") {
            errorMessages.push("Name is required");
        }
        if (email.trim() === "") {
            errorMessages.push("Email is required");
        }
        if (password.trim() === "") {
            errorMessages.push("Password is required");
        }
        if (roles.trim() === "") {
            errorMessages.push("Roles is required");
        }

        // Menampilkan pesan kesalahan jika ada
        if (errorMessages.length > 0) {
            // Jika terdapat pesan kesalahan, reset hanya pada input yang memiliki pesan kesalahan
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                html: errorMessages.join('<br>'), // Menampilkan pesan kesalahan dalam format yang terbaca
            });
        } else {
            // Jika tidak ada pesan kesalahan, tampilkan pesan konfirmasi
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to create this user?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, create it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengklik 'Yes', submit form untuk membuat pengguna
                    form.submit();
                }
            });
        }
    }

    btnSave.onclick = function () {
        simpan();
    };
</script>

@endsection
