<?php

namespace App\Models\Apartment;

use App\Models\Hotel\Hotel;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected  $table = 'apartments';

    protected $fillable = [
        'name',
        'image',
        'max_persons',
        'size',
        'view',
        'num_beds',
        'hotel_id',
        'price'
    ];
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public $timestamps = true;
}
