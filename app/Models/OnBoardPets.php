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
        'dueAmount',
        'status'
    ];

    public function locker(){
        return $this->belongsTo(Petlocker::class, 'lockerId', 'id');

    }
    public function weight(){
        return $this->belongsTo(OnBoardPricing::class, 'pricingId', 'id');

    }
}
