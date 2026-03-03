<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;
use App\Models\Apartment\Apartment;
use App\Models\Booking\Booking;
use App\Models\Hotel\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    public function rooms($id)
    {
        $getRooms = Apartment::query()->select()->orderBy('id','desc')
            ->take(6)
            ->where('hotel_id', $id)->get();

        return view('hotels.rooms', compact('getRooms'));
    }

    public function roomsDetails($id)
    {
        $getRoom = Apartment::query()->find($id);
        return view('hotels.rooms-details', compact('getRoom'));
    }

    public function roomsBooking($id, Request $request)
    {
        $room = Apartment::query()->find($id);
        $hotel = Hotel::query()->find($room->hotel_id);

        if ($request->check_in >= date('Y-m-d')) {


            if ($request->check_in < $request->check_out) {

                $datetime1 = new \DateTime($request->check_in);
                $datetime2 = new \DateTime($request->check_out);
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');


                  $bookRooms = Booking::query()->create([
                      'name' => $request->name,
                      'email' => $request->email,
                      'phone_number' => $request->phone_number,
                      'check_in' => $request->check_in,
                      'check_out' => $request->check_out,
                      'days' => $days,
                      'user_id' => Auth::user()->id,
                      'price' => $days * $room->price,
                      'room_name' => $room->name,
                      'hotel_name' => $hotel->name,

                  ]);

                return redirect()->route('booking.payment', $bookRooms->id)
                    ->with('success', 'Room booked successfully, please proceed to payment');

            } else {
                return back()->with( 'error_dates',"check out date must be greater than check in date");
            }
        }
        else{
            return back()->with( 'errors', "choose dates in the future,invalid check in or check out date");
        }
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('payment.fake', compact('booking'));
    }

    public function pay($id)
    {
        $booking = Booking::findOrFail($id);

        // fake payment success
        $booking->update([
            'status' => 'paid'
        ]);

        return redirect("/booking/$id/success");
    }

    public function success($id)
    {
        $booking = Booking::findOrFail($id);
        return view('payment.success', compact('booking'));
    }
}
