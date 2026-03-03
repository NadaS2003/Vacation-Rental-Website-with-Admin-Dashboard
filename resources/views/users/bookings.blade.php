<x-app-layout>
    <x-slot >
        <section class="hero-wrap hero-wrap-2" style="background-image: url({{asset('assets/images/room-6.jpg')}});" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 ftco-animate text-center">
                        <h1 class="mb-0 bread">My Bookings</h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Check In</th>
                        <th scope="col">Check Out</th>
                        <th scope="col">Days</th>
                        <th scope="col">Price</th>
                        <th scope="col">Room Name</th>
                        <th scope="col">Hotel Name</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <th scope="row">{{$booking->name}}</th>
                        <td>{{$booking->email}}</td>
                        <td>{{$booking->phone_number}}</td>
                        <td>{{$booking->check_in}}</td>
                        <td>{{$booking->check_out}}</td>
                        <td>{{$booking->days}}</td>
                        <td>{{$booking->price}}</td>
                        <td>{{$booking->room_name}}</td>
                        <td>{{$booking->hotel_name}}</td>
                        <td>{{$booking->status}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>
