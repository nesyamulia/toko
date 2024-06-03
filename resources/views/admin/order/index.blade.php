@extends('admin.dashboard.main')
@section('title', 'Orders')
@section('sidenav')
    @include('admin.dashboard.sidenav')
@endsection
@section('page', 'Orders')
@section('nav')
    @include('admin.dashboard.nav')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Table of Orders</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Order Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Order Date</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Product </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Total Amount</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Payment Method</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Payment Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Delivery Date</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Loop through Order data -->
                                    @foreach($orders as $index => $order)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $order->order_no }}</td>
                                        <td class="text-center">{{ $order->first_name . ' ' . $order->last_name }}</td>
                                        <td class="text-center">{{ $order->order_date }}</td>
                                        <td class="text-center">
                                            <ul>
                                                @foreach ($order->items as $item)
                                                    <li>
                                                        {{ $item->product->product_name }} x {{ $item->quantity }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="text-center">{{ $order->total_amount }}</td>
                                        <td class="text-center">{{ $order->payment_method }}</td>
                                        <td class="text-center">{{ $order->payment_status }}</td>
                                        <td class="text-center">{{ $order->status }}</td>
                                        <td class="text-center">{{ $order->delivered_date }}</td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('order.edit', $order->id) }}" class="badge badge-sm bg-gradient-success">Edit</a>
                                            <a href="#" onclick="event.preventDefault(); confirmDelete('{{ $order->id }}')" class="badge badge-sm bg-gradient-danger">Delete</a>

                                            <form id="frmDelete{{ $order->id }}" action="{{ route('order.destroy', $order->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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

    <input type="hidden" id="status" class="form-control" value="@isset($status){{$status}}@endisset">
    <input type="hidden" id="pesan" class="form-control" value="@isset($pesan){{$pesan}}@endisset">

    <!-- Tambahkan kode berikut -->
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{!! html_entity_decode(session('success')) !!}',
        });
    </script>
    @endif

    <!-- Script SweetAlert2 -->
    <script>
        function confirmDelete(orderId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete the order. This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengklik 'Yes', submit form untuk menghapus data
                    document.getElementById('frmDelete' + orderId).submit();
                }
            });
        }
    </script>
@endsection
