<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnBoardPets extends Model
{
    use HasFactory;

    protected $fillable = [
        'petName',
        'age',
        'weight',
        'pricingId',
        'lockerId',
        'checkIn',
        'checkOut',
        'lastUpdate',
        'description',
        'instructions',
        'paymentStatus',
        'dueAmount'
    ];

    public function locker(){
        return $this->belongsTo(Petlocker::class, 'lockerId', 'id');

    }
}