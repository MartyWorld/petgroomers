<?php

namespace App\Http\Controllers;

use App\Models\OnBoardPets;
use App\Models\OnBoardPricing;
use App\Models\Petlocker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class Dashboard extends Controller
{

    protected $DOG_RATE_UNDER_2;
    protected $DOG_RATE_2_TO_5;
    protected $DOG_RATE_OVER_5;
    protected $CAT_RATE;

    public function __constructor(){
        $this->CAT_RATE = 0;
        $this->DOG_RATE_2_TO_5 = 0;
        $this->DOG_RATE_UNDER_2 = 0;
        $this->DOG_RATE_OVER_5 = 0;
    }

    public function index(Request $request){

        $data['availableLockers'] = Petlocker::where('petId', '=' ,0)->get()->toArray();
        $data['pricing'] = OnBoardPricing::all();
        $data['records'] = OnBoardPets::with('locker','weight')->whereIn('status',['checkIn','checkOut'])->orderBy('status','ASC')->OrderBy('id','DESC')->get()->toArray();
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
            return Redirect::back()->withErrors('Something went wrong Please try again later');

        }

    }

    public function getRecords(Request $request){

    }

    public function updateRecords(){

    }



    public function updateStatus(Request $request){
        $req = $request->all();
        if($req['actionType'] == 'checkOut'){
            Petlocker::where('petId',$req['id'])->update([
                'petId' => 0,
                'petName' => null,
                'petInTime' => null,
                'petOutTime' => null
            ]);

            OnBoardPets::where('id',$req['id'])->update([
               'status'=>'checkOut',
                'checkOut' => now()
            ]);
            return redirect()->back()->with('message','Pet Successfully Checkout from System');

        }elseif ($req['actionType'] == 'deleted'){
            Petlocker::where('petId',$req['id'])->update([
                'petId' => 0,
                'petName' => null,
                'petInTime' => null,
                'petOutTime' => null
            ]);

            OnBoardPets::where('id',$req['id'])->delete();
            return redirect()->back()->with('message','Record has been deleted Successfully');
        }
        return Redirect::back()->withErrors('Something went wrong Please try again later');
    }


}
