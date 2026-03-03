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
                    <h5 class="card-title mb-5 d-inline">Create Room</h5>

                    <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="form-group mb-4">
                            <label for="name">Room Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter room name" required>
                        </div>

                        <!-- Image -->
                        <div class="form-group mb-4">
                            <label for="image">Room Image</label>
                            <input type="file" name="image" id="image" class="form-control" required>
                        </div>

                        <!-- Price -->
                        <div class="form-group mb-4">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Enter price" required>
                        </div>

                        <!-- Max Persons -->
                        <div class="form-group mb-4">
                            <label for="max_persons">Number of Persons</label>
                            <input type="text" name="max_persons" id="max_persons" class="form-control" placeholder="Enter number of persons" required>
                        </div>

                        <!-- Number of Beds -->
                        <div class="form-group mb-4">
                            <label for="num_beds">Number of Beds</label>
                            <input type="text" name="num_beds" id="num_beds" class="form-control" placeholder="Enter number of beds" required>
                        </div>

                        <!-- Size -->
                        <div class="form-group mb-4">
                            <label for="size">Size</label>
                            <input type="text" name="size" id="size" class="form-control" placeholder="Enter room size" required>
                        </div>

                        <!-- View -->
                        <div class="form-group mb-4">
                            <label for="view">View</label>
                            <input type="text" name="view" id="view" class="form-control" placeholder="Enter room view" required>
                        </div>

                        <!-- Hotel Select -->
                        <div class="form-group mb-4">
                            <label for="hotel_id">Select Hotel</label>
                            <select name="hotel_id" id="hotel_id" class="form-control" required>
                                <option value="">-- Choose Hotel Name --</option>
                                @foreach($hotels as $hotel)
                                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-pink mb-4">
                            <i class="fas fa-plus"></i> Create
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
