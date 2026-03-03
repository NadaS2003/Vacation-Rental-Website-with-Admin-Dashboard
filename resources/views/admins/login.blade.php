@extends('layouts.admin')
@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-lg rounded-lg">
                <div class="card-body">
                    <h5 class="card-title text-center my-4" style="font-weight:700; color:#ff6f91;">Admin Login</h5>

                    <form method="POST" action="{{ route('check.login') }}">
                        @csrf

                        <!-- Email input -->
                        <div class="form-group mb-3">
                            <label for="email" class="font-weight-bold">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>

                        <!-- Password input -->
                        <div class="form-group mb-3">
                            <label for="password" class="font-weight-bold">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                        </div>

                        <!-- Submit button -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-pink btn-block">
                                <i class="fas fa-sign-in-alt mr-2"></i> Login
                            </button>
                        </div>
                    </form>

                    <!-- Optional: Forgot password link -->
                    <p class="text-center mt-3">
                        <a href="#" class="text-pink" style="color:#ff6f91;">Forgot password?</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional CSS for this page -->
    <style>
        :root {
            --pink: #ff6f91;
            --pink-soft: #ffe4ec;
            --black: #222222;
            --gray: #f5f5f5;
            --white: #ffffff;
        }

        body {
            background-color: var(--gray);
            font-family: 'Segoe UI', sans-serif;
        }

        .content {
            flex: 1;
            padding: 40px 30px 30px;
        }
        .btn-pink {
            background-color: #ff6f91;
            color: #fff;
            border-radius: 25px;
            padding: 10px 22px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
        }
        .btn-pink:hover {
            background-color: #ff4f7b;
        }
        .text-pink:hover {
            text-decoration: underline;
        }
    </style>

@endsection
