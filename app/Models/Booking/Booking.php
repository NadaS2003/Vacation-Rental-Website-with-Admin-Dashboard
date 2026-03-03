<?php

namespace App\Models\Booking;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected  $table = 'bookings';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'check_in',
        'check_out',
        'days',
        'user_id',
        'price',
        'room_name',
        'hotel_name',
        'status'
    ];

    public $timestamps = true;
}
