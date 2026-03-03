<?php

namespace App\Http\Controllers;

use App\Models\Apartment\Apartment;
use App\Models\Hotel\Hotel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $hotels = Hotel::query()->select()->orderBy('id', 'desc')->take(3)->get();
        $rooms = Apartment::query()->select()->orderBy('id', 'desc')->take(4)->get();
        return view('dashboard',compact('hotels','rooms'));
    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        return view('pages.services');
    }

    public function contact(){
        return view('pages.contact');
    }
}
