<x-app-layout>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0 text-center">
                        <div class="card-body p-5">

                            <span class="fa fa-check-circle text-success mb-4" style="font-size: 70px;"></span>

                            <h2 class="mb-3">Payment Successful</h2>
                            <p class="text-muted mb-4">
                                Your booking has been confirmed successfully.
                            </p>

                            <div class="alert alert-success">
                                <strong>Status:</strong> {{ ucfirst($booking->status) }}
                            </div>

                            <div class="row mt-4 text-left">
                                <div class="col-md-6">
                                    <p><strong>Hotel:</strong> {{ $booking->hotel_name }}</p>
                                    <p><strong>Room:</strong> {{ $booking->room_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Check In:</strong> {{ $booking->check_in }}</p>
                                    <p><strong>Check Out:</strong> {{ $booking->check_out }}</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary px-4 py-2 mr-2">
                                    <span class="fa fa-home mr-1"></span> Home
                                </a>
                                <a href="{{ url('/hotels') }}" class="btn btn-outline-secondary px-4 py-2">
                                    <span class="fa fa-bed mr-1"></span> Browse Rooms
                                </a>
                            </div>

                            <p class="text-muted mt-4" style="font-size: 14px;">
                                <span class="fa fa-info-circle"></span>
                                This is a demo confirmation page for portfolio purposes.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
