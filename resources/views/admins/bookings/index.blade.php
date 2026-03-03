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
            padding: 40px 20px 30px;
        }
        .toast-notification {
            background-color: var(--pink); /* الوردي */
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

        /* تحسين الجدول */
        .table-bookings th, .table-bookings td {
            vertical-align: middle;
            text-align: center;
            font-size: 0.8rem;
        }

        .table-bookings tbody tr:hover {
            background-color: var(--pink-soft);
        }

        .table-bookings img {
            border-radius: 8px;
            object-fit: cover;
            width: 60px;
            height: 60px;
        }

        .btn-sm-custom {
            padding: 4px 10px;
            font-size: 0.8rem;
        }
    </style>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline">Bookings</h5>

                <div class="table-responsive">
                    <table class="table table-bookings table-hover table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Full Name</th>
                            <th>Hotel</th>
                            <th>Room</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Change</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <th>{{ $booking->id }}</th>
                                <td>{{ $booking->check_in }}</td>
                                <td>{{ $booking->check_out }}</td>
                                <td>{{ $booking->email }}</td>
                                <td>{{ $booking->phone_number }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->hotel_name }}</td>
                                <td>{{ $booking->room_name }}</td>
                                <td>
                                    <span class="badge {{ $booking->status == 'Booked Successfully' ? 'badge-success' : ($booking->status == 'processing' ? 'badge-warning' : 'badge-secondary') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>${{ $booking->price }}</td>
                                <td>
                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm btn-sm-custom">
                                        <i class="fas fa-exchange-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.bookings.delete', $booking->id) }}" class="btn btn-danger btn-sm btn-sm-custom">
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
