<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petlocker extends Model
{
    use HasFactory;

    protected $fillable = [
        'LockerName',
        'petId',
        'petName',
        'petInTime',
        'petOutTime'
    ];
}
