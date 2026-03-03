<?php

namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected  $table = 'hotels';

    protected $fillable = [
        'name',
        'image',
        'location',
        'description',
    ];

    public $timestamps = true;

}
