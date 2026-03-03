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
    </style>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline">Rooms</h5>
                <a href="{{ route('admin.rooms.create') }}" class="btn btn-pink float-right mb-3">
                    <i class="fas fa-plus"></i> Create Room
                </a>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Num of persons</th>
                            <th>Size</th>
                            <th>View</th>
                            <th>Num of beds</th>
                            <th>Hotel name</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rooms as $room)
                            <tr>
                                <th scope="row">{{ $room->id }}</th>
                                <td>{{ $room->name }}</td>
                                <td>
                                    <img src="{{ asset('assets/images/' . $room->image) }}" width="60" height="60" class="rounded">
                                </td>
                                <td>${{ $room->price }}</td>
                                <td>{{ $room->max_persons }}</td>
                                <td>{{ $room->size }}</td>
                                <td>{{ $room->view }}</td>
                                <td>{{ $room->num_beds }}</td>
                                <td>{{ $room->hotel->name }}</td>
                                <td>
                                    <a href="{{ route('admin.rooms.delete', $room->id) }}" class="btn btn-danger btn-sm btn-sm-custom">
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
