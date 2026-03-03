<x-app-layout>
    <x-slot>
        <div class="hero-wrap js-fullheight" style="background-image: url('{{asset('assets/images/'.$getRoom->image.'')}}');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
                    <div class="col-md-7 ftco-animate">
                        <h2 class="subheading">Welcome to Vacation Rental</h2>
                        <h1 class="mb-4">{{$getRoom->name}}</h1>
                        <!-- <p><a href="#" class="btn btn-primary">Learn more</a> <a href="#" class="btn btn-white">Contact us</a></p> -->
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="container mt-4">--}}
{{--            @if(session()->has('error') || session()->has('error_dates'))--}}
{{--                <div class="alert alert-danger alert-dismissible fade show rounded shadow-sm" role="alert">--}}
{{--                    <span class="fa fa-exclamation-circle mr-2"></span>--}}
{{--                    {{ session('error') ?? session('error_dates') }}--}}
{{--                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
        <!-- Toast Container -->
        <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

        <!-- Blade: عرض الرسالة إذا موجودة -->
        @if(session()->has('error') || session()->has('error_dates'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // محتوى الرسالة
                    let message = "{{ session('error') ?? session('error_dates') }}";

                    // إنشاء عنصر Toast
                    let toast = document.createElement('div');
                    toast.className = "toast-notification shadow rounded";
                    toast.innerHTML = `<span class="fa fa-exclamation-circle mr-2"></span> ${message}`;

                    // إضافة العنصر للـ container
                    document.getElementById('toast-container').appendChild(toast);

                    // إظهار الرسالة مع حركة
                    setTimeout(() => toast.classList.add('show'), 100);

                    // إزالة الرسالة بعد 5 ثواني
                    setTimeout(() => toast.classList.remove('show'), 5000);

                    // إزالة العنصر من الـ DOM بعد انتهاء الحركة
                    setTimeout(() => toast.remove(), 5500);
                });
            </script>
        @endif

        <!-- CSS للإشعار -->
        <style>
            .toast-notification {
                background-color: #f44336; /* أحمر للخطأ */
                color: #fff;
                padding: 15px 20px;
                margin-top: 10px;
                min-width: 250px;
                border-radius: 8px;
                opacity: 0;
                transform: translateX(100%);
                transition: all 0.5s ease;
                font-size: 14px;
                display: flex;
                align-items: center;
            }
            .toast-notification.show {
                opacity: 1;
                transform: translateX(0);
            }
            .toast-notification .fa {
                margin-right: 10px;
            }
        </style>

        <section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-4">
                        <form action="{{{route('hotels.rooms.booking',$getRoom->id)}}}" method="POST" class="appointment-form" style="margin-top: -568px;">
                            @csrf
                            <h3 class="mb-3">Book this room</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Full Name">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="phone_number" placeholder="Phone Number">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-wrap">
                                            <div class="icon"><span class="ion-md-calendar"></span></div>
                                            <input type="date" class="form-control" name="check_in" placeholder="Check-In">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="icon"><span class="ion-md-calendar"></span></div>
                                        <input type="date" class="form-control" name="check_out" placeholder="Check-Out">
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="form-group">
                                        @if(isset(Auth::user()->id))
                                        <input type="submit" value="Book and Pay Now" class="btn btn-primary py-3 px-4">
                                        @else
                                            <p class="alert alert-danger"> Login to book a room</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>






        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-6 wrap-about">
                        <div class="img img-2 mb-4" style="background-image: url('{{asset('assets/images/'.$getRoom->image.'')}}');">
                        </div>
                        <h2>The most recommended vacation rental</h2>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                    </div>
                    <div class="col-md-6 wrap-about ftco-animate">
                        <div class="heading-section">
                            <div class="pl-md-5">
                                <h2 class="mb-2">What we offer</h2>
                            </div>
                        </div>
                        <div class="pl-md-5">
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                            <div class="row">
                                <div class="services-2 col-lg-6 d-flex w-100">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="flaticon-diet"></span>
                                    </div>
                                    <div class="media-body pl-3">
                                        <h3 class="heading">Tea Coffee</h3>
                                        <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                    </div>
                                </div>
                                <div class="services-2 col-lg-6 d-flex w-100">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="flaticon-workout"></span>
                                    </div>
                                    <div class="media-body pl-3">
                                        <h3 class="heading">Hot Showers</h3>
                                        <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                    </div>
                                </div>
                                <div class="services-2 col-lg-6 d-flex w-100">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="flaticon-diet-1"></span>
                                    </div>
                                    <div class="media-body pl-3">
                                        <h3 class="heading">Laundry</h3>
                                        <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                    </div>
                                </div>
                                <div class="services-2 col-lg-6 d-flex w-100">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="flaticon-first"></span>
                                    </div>
                                    <div class="media-body pl-3">
                                        <h3 class="heading">Air Conditioning</h3>
                                        <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                    </div>
                                </div>
                                <div class="services-2 col-lg-6 d-flex w-100">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="flaticon-first"></span>
                                    </div>
                                    <div class="media-body pl-3">
                                        <h3 class="heading">Free Wifi</h3>
                                        <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                    </div>
                                </div>
                                <div class="services-2 col-lg-6 d-flex w-100">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="flaticon-first"></span>
                                    </div>
                                    <div class="media-body pl-3">
                                        <h3 class="heading">Kitchen</h3>
                                        <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                    </div>
                                </div>
                                <div class="services-2 col-lg-6 d-flex w-100">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="flaticon-first"></span>
                                    </div>
                                    <div class="media-body pl-3">
                                        <h3 class="heading">Ironing</h3>
                                        <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                    </div>
                                </div>
                                <div class="services-2 col-lg-6 d-flex w-100">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="flaticon-first"></span>
                                    </div>
                                    <div class="media-body pl-3">
                                        <h3 class="heading">Lovkers</h3>
                                        <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-intro" style="background-image: url('{{asset('assets/images/'.$getRoom->image.'')}}')" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 text-center">
                        <h2>Ready to get started</h2>
                        <p class="mb-4">It’s safe to book online with us! Get your dream stay in clicks or drop us a line with your questions.</p>
                        <p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Learn More</a> <a href="#" class="btn btn-white px-4 py-3">Contact us</a></p>
                    </div>
                </div>
            </div>
        </section>

    </x-slot>
</x-app-layout>
