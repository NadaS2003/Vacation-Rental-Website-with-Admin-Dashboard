@extends('layouts.admin')
@section('content')

    <!-- Toast Container -->
    <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

    @if(session()->has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let message = "{{ session('success') }}";
                let toast = document.createElement('div');
                toast.className = "toast-notification shadow rounded";
                toast.innerHTML = `<i class="fas fa-check-circle mr-2"></i> ${message}`;
                document.getElementById('toast-container').appendChild(toast);
                setTimeout(() => toast.classList.add('show'), 100);
                setTimeout(() => toast.classList.remove('show'), 5000);
                setTimeout(() => toast.remove(), 5500);
            });
        </script>
    @endif

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
            background-color: var(--pink);
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

        /* أيقونات الأزرار */
        .btn-icon {
            padding: 6px 10px;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
        }
        .btn-icon i {
            font-size: 16px;
        }
        .btn-icon-update {
            background-color: #ffc107; /* برتقالي */
            color: #fff;
            border: none;
        }
        .btn-icon-update:hover {
            background-color: #e0a800;
        }
        .btn-icon-delete {
            background-color: #dc3545; /* أحمر */
            color: #fff;
            border: none;
        }
        .btn-icon-delete:hover {
            background-color: #c82333;
        }
    </style>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline">Hotels</h5>
                <a href="{{ route('admin.hotels.create') }}" class="btn btn-pink float-right mb-3">
                    <i class="fas fa-plus"></i>
                </a>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hotels as $hotel)
                            <tr>
                                <th scope="row">{{ $hotel->id }}</th>
                                <td>{{ $hotel->name }}</td>
                                <td>{{ $hotel->location }}</td>
                                <td>{{ $hotel->description }}</td>
                                <td>
                                    <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="btn btn-warning btn-sm btn-sm-custom">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.hotels.delete', $hotel->id) }}" class="btn btn-danger btn-sm btn-sm-custom">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection
