<x-app-layout>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">

                            <div class="text-center mb-4">
                                <span class="fa fa-credit-card fa-3x text-primary mb-3"></span>
                                <h2 class="mb-2">Payment Details</h2>
                                <p class="text-muted">Please review your booking before payment</p>
                            </div>

                            <hr>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p><strong>Hotel</strong></p>
                                    <p>{{ $booking->hotel_name }}</p>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <p><strong>Room</strong></p>
                                    <p>{{ $booking->room_name }}</p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p><strong>Check In</strong></p>
                                    <p>{{ $booking->check_in }}</p>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <p><strong>Check Out</strong></p>
                                    <p>{{ $booking->check_out }}</p>
                                </div>
                            </div>

                            <div class="alert alert-info d-flex justify-content-between align-items-center">
                                <span><strong>Total Amount</strong></span>
                                <span class="h4 mb-0">${{ $booking->price }}</span>
                            </div>

                            <form method="POST" action="{{ route('booking.pay', $booking->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">
                                    <span class="fa fa-lock mr-2"></span> Pay Now
                                </button>
                            </form>

                            <p class="text-center text-muted mt-4" style="font-size: 14px;">
                                <span class="fa fa-info-circle"></span>
                                This is a demo payment for portfolio purposes only.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
