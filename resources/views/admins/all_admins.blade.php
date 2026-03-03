@extends('layouts.admin')
@section('content')

    <!-- Toast Container -->
    <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

    <!-- عرض الرسالة إذا موجودة -->
    @if(session()->has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let message = "{{ session('success') }}";

                let toast = document.createElement('div');
                toast.className = "toast-notification shadow rounded";
                toast.innerHTML = `<i class="fas fa-check-circle mr-2"></i> ${message}`;

                document.getElementById('toast-container').appendChild(toast);

                // إظهار الرسالة
                setTimeout(() => toast.classList.add('show'), 100);

                // إزالة الرسالة بعد 5 ثواني
                setTimeout(() => toast.classList.remove('show'), 5000);
                setTimeout(() => toast.remove(), 5500);
            });
        </script>
    @endif

    <!-- Toast CSS -->
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

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline">Admins</h5>
                <a href="{{ route('admins.create') }}" class="btn btn-pink float-right mb-3">
                    <i class="fas fa-plus"></i> Create Admin
                </a>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <th scope="row">{{ $admin->id }}</th>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
