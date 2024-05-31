<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <title>Register</title>

    <style>
        /* Custom CSS for the button */
        .btn-register {
            background-color: #28a745; /* Green color */
            color: #fff; /* White text color */
            padding: 15px 30px; /* Padding */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Cursor on hover */
            text-decoration: none; /* No underline */
            display: block; /* Display as block element */
            margin: 0 auto; /* Center horizontally */
            width: 100%; /* Set width to 100% */
            max-width: 400px; /* Set maximum width */
        }

        .btn-register:hover {
            background-color: #218838; /* Darker green on hover */
        }
    </style>
</head>
<body>
<section class="form-02-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="_lk_de">
                    <div class="form-03-main">
                        <div class="logo">
                            <img src="{{ asset('assets/images/logo nersmart.png') }}" style="border-radius: 100%;"> 
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control _ge_de_ol" placeholder="Enter Name" required="" aria-required="true" value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control _ge_de_ol" placeholder="Enter Email" required="" aria-required="true" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control _ge_de_ol" placeholder="Enter Password" required="" aria-required="true">
                            </div>

                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control _ge_de_ol" placeholder="Confirm Password" required="" aria-required="true">
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn-register">Register</button>
                            </div>
                        </form>

                        <!-- Display validation errors if any -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
