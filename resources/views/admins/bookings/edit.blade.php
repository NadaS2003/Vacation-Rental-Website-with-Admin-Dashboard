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
    <div class="container-fluid" style="padding-left:10px; padding-right:10px;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Update Booking Status</h5>
                <p>Current Status:
                    @php
                        switch($booking->status){
                            case 'processing': $statusLabel='processing'; $statusClass='badge-warning'; break;
                            case 'Booked Successfully': $statusLabel='Booked Successfully'; $statusClass='badge-success'; break;
                            default: $statusLabel='غير معروف'; $statusClass='badge-secondary';
                        }
                    @endphp
                    <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                </p>

                <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="status">Select Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="" disabled selected>-- Select Status --</option>
                            <option value="processing" {{ $booking->status=='processing' ? 'selected' : '' }}>Processing</option>
                            <option value="Booked Successfully" {{ $booking->status=='Booked Successfully' ? 'selected' : '' }}>Booked Successfully</option>
                        </select>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-pink">Update</button>
                </form>

            </div>
        </div>
    </div>

@endsection
