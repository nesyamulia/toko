@extends('frontend.landingpage.main')
@section('title', 'Wishlist')
@section('page', 'Wishlist')
@section('header')
    @include('frontend.landingpage.header')
    <!-- Wishlist Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (Cart::instance('wishlist_' . Auth::guard('users')->user()->id)->count() > 0)
                            @foreach ($wishlistItems as $item)
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($item->options->image) }}"
                                                class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                                alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">{{ $item->name }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="removeFromWishlist('{{ $item->rowId }}')" class="btn btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Wishlist is empty</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Wishlist Page End -->

        <form action="{{ route('removeWishlist') }}" id="wishlist-remove" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="rowId" id="rowId">
        </form>

        <script>
            function removeFromWishlist(rowId) {
                $('#rowId').val(rowId);
                $('#wishlist-remove').submit();
            }
        </script>


    @endsection
