<?php

namespace App\Http\Controllers;

use App\Models\OnBoardPets;
use App\Models\OnBoardPricing;
use App\Models\Petlocker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class Dashboard extends Controller
{



    public function index(Request $request){

        $data['availableLockers'] = Petlocker::where('petId', '=' ,0)->get()->toArray();
        $data['pricing'] = OnBoardPricing::all();
        $data['records'] = OnBoardPets::with('locker')->OrderBy('id','DESC')->get()->toArray();
        return view('admin.dashboard',$data);

    }

    public function addRecords(Request $request){

        $req = $request->all();
        $getPriceDetails = OnBoardPricing::where('id',$req['weight'])->first();
        $petID = OnBoardPets::create([
            "petType" => $req["petType"],
            "petName" => $req["petName"],
            "age" => $req["age"],
            "days" => $req["days"],
            "weight" => 0,
            "checkIn" => $req["checkInTime"],
            "checkOut" => $req["checkOut"],
            "dueAmount" => $getPriceDetails->price*$req["days"],
            "paymentStatus" => $req["paymentStatus"],
            "description" => $req["description"],
            "instructions" => $req["instructions"],
            'pricingId' => $req['weight'],
            'lockerId' => $req['lockerId']
        ])->id;

        if($petID){
            Petlocker::where('id',$req['lockerId'])->update([
                'petId' => $petID,
                'petName' => $req["petName"],
                'petInTime' => $req["checkInTime"],
                'petOutTime' => $req["checkOut"]
            ]);
            return redirect()->back()->with('message', $req['petName'].' Added Successfully in Database');

        }else{
            return Redirect::back()->withErrors('Something went wrong Please try agian later');

        }

    }

}
