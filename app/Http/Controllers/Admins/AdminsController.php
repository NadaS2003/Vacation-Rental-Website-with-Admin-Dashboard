<?php

namespace App\Http\Controllers\Admins;

use App\Charts\SampleChart;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Apartment\Apartment;
use App\Models\Booking\Booking;
use App\Models\Hotel\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminsController extends Controller
{
    public function ViewLogin()
    {
        return view('admins.login');
    }

    public function checkLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }


    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        return redirect()->route('view.login');
    }

    public function index()
    {
        // إحصائيات عددية للبطاقات الرئيسية
        $adminCount = Admin::count();
        $hotelCount = Hotel::count();
        $roomCount = Apartment::count();

        // إحصائيات إضافية
        $activeUsers = User::count(); // المستخدمون النشطون
        $newReservations = Booking::whereDate('created_at', today())->count(); // الحجوزات المضافة اليوم
        $totalRevenue = Booking::sum('price'); // إجمالي الإيرادات

        // الحصول على أسماء الغرف المحجوزة
        $occupiedRooms = DB::table('bookings')
            ->select('room_name') // عمود اسم الغرفة المحجوزة
            ->distinct() // لضمان عدم تكرار الأسماء
            ->pluck('room_name') // استخراج الأسماء كـ collection
            ->toArray(); // تحويلها إلى مصفوفة

        // الحصول على العدد الإجمالي للغرف من جدول الغرف
        $totalRooms = DB::table('apartments')
            ->count(); // عدّ جميع الغرف

        // مقارنة أسماء الغرف المحجوزة مع أسماء الغرف المسجلة
        $occupiedRoomCount = DB::table('apartments')
            ->whereIn('name', $occupiedRooms) // إحضار الغرف المطابقة لأسماء الغرف المحجوزة
            ->count(); // عدّ عدد الغرف المحجوزة الموجودة في جدول الغرف

        // حساب نسبة الإشغال
        if ($totalRooms > 0) {
            $roomOccupancyPercent = ($occupiedRoomCount / $totalRooms) * 100; // النسبة المئوية لإشغال الغرف
        } else {
            $roomOccupancyPercent = 0; // إذا لم توجد غرف تكون النسبة صفر
        }



        // تمرير البيانات للـ View
        return view('admins.dashboard', compact(
            'adminCount',
            'hotelCount',
            'roomCount',
            'activeUsers',
            'newReservations',
            'totalRevenue',
            'roomOccupancyPercent',
            'totalRooms',
            'occupiedRooms'

        ));
    }

    public function allAdmins()
    {
        $admins = Admin::query()->select()->orderBy('id','asc')->get();
        return view('admins.all_admins', compact('admins'));
    }

    public function createAdmins()
    {
        return view('admins.create-admins');
    }

    public function storeAdmins(Request $request)
    {
        $storeAdmins = Admin::query()->create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->input('password')),
        ]);

        if ($storeAdmins)
        {
            return redirect()->route('admins.all')->with('success', 'Admin created successfully.');
        }

    }


    public function allHotels()
    {
        $hotels = Hotel::query()->select()->orderBy('id','asc')->get();
        return view('admins.hotels.index', compact('hotels'));
    }

    public function createHotels()
    {
        return view('admins.hotels.create');
    }

    public function storeHotels(Request $request)
    {

        Request()->validate([
            'name' => 'required|string|max:40',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $storeHotels = Hotel::query()->create([
            "name" => $request->name,
            "description" => $request->description,
            "location" => $request->location,
            "image" => $myimage,
        ]);



        if ($storeHotels)
        {
            return redirect()->route('admin.hotels.all')->with('success', 'Hotel created successfully.');
        }

    }

    public function editHotels($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('admins.hotels.edit', compact('hotel'));
    }

    public function updateHotels(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);

        Request()->validate([
            'name' => 'required|string|max:40',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $destinationPath = 'assets/images/';
            $myimage = $request->image->getClientOriginalName();
            $request->image->move(public_path($destinationPath), $myimage);
            $hotel->image = $myimage;
        }

        $hotel->name = $request->name;
        $hotel->description = $request->description;
        $hotel->location = $request->location;
        $hotel->save();

        return redirect()->route('admin.hotels.all')->with('success', 'Hotel updated successfully.');
    }
    public function deleteHotels($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->route('admin.hotels.all')->with('success', 'Hotel deleted successfully.');
    }


    public function allRooms()
    {
        $rooms = Apartment::query()->select()->orderBy('id','asc')->get();
        return view('admins.Rooms.index', compact('rooms'));
    }

    public function createRooms()
    {
        $hotels = Hotel::query()->select()->orderBy('id','asc')->get();

        return view('admins.Rooms.create',compact('hotels'));
    }

    public function storeRooms(Request $request)
    {

        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $storeApartments = Apartment::query()->create([
            "name" => $request->name,
            "price" => $request->price,
            "view" => $request->view,
            "max_persons" => $request->max_persons,
            "size" => $request->size,
            "num_beds" => $request->num_beds,
            "hotel_id" => $request->hotel_id,
            "image" => $myimage,
        ]);



        if ($storeApartments)
        {
            return redirect()->route('admin.rooms.all')->with('success', 'Room created successfully.');
        }


    }

    public function deleteRooms($id)
    {
        $hotel = Apartment::findOrFail($id);
        $hotel->delete();

        return redirect()->route('admin.rooms.all')->with('success', 'Hotel deleted successfully.');
    }

    public function allBookings()
    {

        $bookings = Booking::query()->select()->orderBy('id','asc')->get();
        return view('admins.bookings.index',compact('bookings'));
    }

    public function editBookings($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admins.bookings.edit', compact('booking'));
    }

    public function updateBookings(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('admin.bookings.all')->with('success', 'Booking updated successfully.');
    }
    public function deleteBookings($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.all')->with('success', 'Booking deleted successfully.');
    }
}
