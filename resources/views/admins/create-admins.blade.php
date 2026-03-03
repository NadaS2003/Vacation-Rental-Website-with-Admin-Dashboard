@extends('layouts.admin')
@section('content')
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
        .toast-notification {
            background-color: var(--pink); /* استخدام اللون الوردي */
            color: var(--white);
            padding: 15px 20px;
            margin-top: 10px;
            min-width: 250px;
            border-radius: 12px;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.5s ease;
            font-size: 14px;
            display: flex;
            align-items: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .toast-notification.show {
            opacity: 1;
            transform: translateX(0);
        }
        .toast-notification .fa {
            margin-right: 10px;
        }
    </style>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Admin</h5>

                    <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Email input -->
                        <div class="form-group mb-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
                        </div>

                        <!-- Name input -->
                        <div class="form-group mb-4">
                            <label for="name">Username</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter username" required>
                        </div>

                        <!-- Password input -->
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-pink mb-4">
                            <i class="fas fa-user-plus"></i> Create
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
