<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom Style -->
    <link href="{{ asset('assets/styles/style.css') }}" rel="stylesheet">
</head>

<body>

<!-- Top Navbar -->
<nav class="navbar navbar-light bg-light fixed-top">
    <a class="navbar-brand font-weight-bold" href="#">Admin Panel</a>

    @auth('admin')
        <div class="dropdown">
            <a class="navbar-brand font-weight-light dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="fas fa-user-circle"></i>
                {{ Auth::guard('admin')->user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item text-danger"
                   href="{{ route('admin.logout') }}"
                  >
                    Logout
                </a>
            </div>
        </div>
    @endauth
</nav>

<div class="d-flex">

    <!-- Sidebar -->
    @auth('admin')
        <aside class="sidebar">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admins.dashboard') }}" class="nav-link">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admins.all') }}" class="nav-link">
                        <i class="fas fa-user-shield"></i> Admins
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.hotels.all') }}" class="nav-link">
                        <i class="fas fa-hotel"></i> Hotels
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.rooms.all') }}" class="nav-link">
                        <i class="fas fa-door-open"></i> Rooms
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.bookings.all') }}" class="nav-link">
                        <i class="fas fa-calendar-check"></i> Bookings
                    </a>
                </li>
            </ul>
        </aside>
    @endauth

    <!-- Main Content -->
    <main class="content">
        @yield('content')
    </main>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
