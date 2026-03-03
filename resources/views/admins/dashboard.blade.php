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

        /* =========================
            Statistics Cards
        ========================= */
        .card-stat {
            height: 150px;
            border-radius: 22px;
            background-color: var(--white);
            color: var(--black);
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
        }

        .card-stat::after {
            content: '';
            position: absolute;
            right: -40px;
            top: -40px;
            width: 120px;
            height: 120px;
            background: var(--pink-soft);
            border-radius: 50%;
        }

        .card-stat:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 40px rgba(0,0,0,0.12);
        }

        .card-stat i {
            font-size: 3.2rem;
            color: var(--pink);
            z-index: 2;
        }

        /* =========================
            Large Cards
        ========================= */
        .card-large {
            border-radius: 22px;
            background-color: var(--white);
            padding: 25px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.07);
        }

        /* =========================
            Progress Bar
        ========================= */
        .progress {
            height: 40px;
            border-radius: 30px;
            background-color: var(--pink-soft);
        }

        .progress-bar {
            border-radius: 30px;
            background: linear-gradient(90deg, var(--pink), #ff9bb5);
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
        }

        /* =========================
            List Group
        ========================= */
        .list-group-item {
            background-color: transparent;
            border: none;
            padding: 14px 10px;
            font-size: 1.05rem;
            color: var(--black);
            display: flex;
            align-items: center;
            transition: 0.3s;
        }

        .list-group-item i {
            color: var(--pink);
            margin-right: 10px;
        }

        .list-group-item:hover {
            transform: translateX(6px);
            color: var(--pink);
        }

        /* =========================
            Badge
        ========================= */
        .badge {
            background-color: var(--black) !important;
            border-radius: 12px;
            padding: 8px 14px;
        }

        /* =========================
            Responsive
        ========================= */
        @media (max-width: 992px) {
            .content {
                padding: 30px 15px;
            }
        }
    </style>

    <!-- Section: Statistics -->
    <div class="row mb-4">
        <!-- Hotels card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg card-stat">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title fs-3">Hotels</h5>
                        <p class="card-text fs-5">Number of hotels: <span class="fw-bold">{{ $hotelCount }}</span></p>
                    </div>
                    <i class="fas fa-hotel"></i>
                </div>
            </div>
        </div>

        <!-- Rooms card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg card-stat">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title fs-3">Rooms</h5>
                        <p class="card-text fs-5">Number of rooms: <span class="fw-bold">{{ $roomCount }}</span></p>
                    </div>
                    <i class="fas fa-bed"></i>
                </div>
            </div>
        </div>

        <!-- Admins card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg card-stat">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title fs-3">Admins</h5>
                        <p class="card-text fs-5">Number of admins: <span class="fw-bold">{{ $adminCount }}</span></p>
                    </div>
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Room Occupancy -->
    <div class="row mb-4">
        <div class="col-md-8 mb-4">
            <div class="card shadow-lg card-large">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title fs-3 mb-0">Room Occupancy</h5>
                    <span class="badge bg-dark fs-5 text-white">{{ round($roomOccupancyPercent, 2) }}%</span>
                </div>
                <hr>
                <p class="card-text fs-5 mb-3">Percentage of occupied rooms compared to total rooms:</p>
                <div class="progress mb-3">
                    <div
                        class="progress-bar"
                        role="progressbar"
                        style="width: {{ $roomOccupancyPercent }}%;"
                        aria-valuenow="{{ $roomOccupancyPercent }}"
                        aria-valuemin="0"
                        aria-valuemax="100">
                        {{ round($roomOccupancyPercent, 2) }}%
                    </div>
                </div>
                <div class="text-black fs-5">
                    Occupied Rooms: <span class="fw-bold">{{ count($occupiedRooms) }}</span> / Total Rooms: <span class="fw-bold">{{ $totalRooms }}</span>
                </div>
            </div>
        </div>

        <!-- Other Statistics -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg card-large">
                <h5 class="card-title fs-3 mb-3">Other Statistics</h5>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="fas fa-users me-2"></i> Active Users: <span class="fw-bold">{{ $activeUsers }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-calendar-plus me-2"></i> New Reservations Today: <span class="fw-bold">{{ $newReservations }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-dollar-sign me-2"></i> Total Revenue: <span class="fw-bold">${{ number_format($totalRevenue, 2) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection
