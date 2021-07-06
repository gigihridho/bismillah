<?php

namespace App\Http\Controllers;

use App\Room;
use App\Rules\Booking;
use App\RoomType;
use App\RoomBooking;
use App\Rules\RoomAvailableRule;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function confirmation(Request $request, $room_type_id){
        $rules = [
            'arrival_date' => 'required|date|after_or_equal:today',
        ];

        $room_type = RoomType::findOrFail($room_type_id);

        $price = $room_type->price;

        $new_arrival_date = $request->input('arrival_date');

        $duration = $request->input('duration');

        if($duration == 1){
            $new_departure_date = date('Y-m-d', strtotime('+1 month', strtotime($request->arrival_date)));
            $total_price = $duration * $price;
        }elseif($duration == 6){
            $new_departure_date = date('Y-m-d', strtotime('+6 month', strtotime($request->arrival_date)));
            $total_price = $duration * $price - (0.5 * $price);
        }else {
            $new_departure_date = date('Y-m-d', strtotime('+12 month', strtotime($request->arrival_date)));
            $total_price = $duration * $price - (1 * $price);
        }

        $rules['booking_validation'] = [new RoomAvailableRule($room_type,$new_arrival_date,$new_departure_date)];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $booking = new Booking($room_type, $new_arrival_date, $new_departure_date);

        return view('confirmation', [
            'room_type_id' => $room_type_id,
            'new_arrival_date' => $new_arrival_date,
            'new_departure_date' => $new_departure_date,
            'room_type' => $room_type,
            'room_number' => $booking->available_room_number(),
            'duration' => $duration,
            'total_price' => $total_price
        ]);
    }

    public function booking(Request $request, $room_type_id){
        $rules = [
            'arrival_date' => 'required|date|after_or_equal:today',
        ];

        $room_type = RoomType::findOrFail($room_type_id);

        $code = 'KGK-' . mt_rand(0000,9999);

        $new_arrival_date = $request->input('arrival_date');

        $duration = $request->input('duration');

        if($duration == 1){
            $new_departure_date = date('Y-m-d', strtotime('+1 month', strtotime($request->arrival_date)));
        }elseif($duration == 6){
            $new_departure_date = date('Y-m-d', strtotime('+6 month', strtotime($request->arrival_date)));
        }else {
            $new_departure_date = date('Y-m-d', strtotime('+12 month', strtotime($request->arrival_date)));
        }
        $rules['booking_validation'] = [new RoomAvailableRule($room_type,$new_arrival_date,$new_departure_date)];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()
            ->withInput($request->all())
                ->withErrors($validator);
            }

        $room_booking = new RoomBooking();
        $user = Auth::user();

        $room_booking->arrival_date = $request->input('arrival_date');
        $room_booking->departure_date = $new_departure_date;
        $room_booking->order_date = Carbon::now();

        $price = $room_type->price;

        if($duration == 1){
            $total_price = $duration * $price;
        } elseif($duration == 6){
            $total_price = $duration * $price - (0.5 * $price);
        } elseif($duration == 12){
            $total_price = $duration * $price - (1 * $price);
        }

        $room_booking->total_price = $total_price;
        $room_booking->user_id = $user->id;

        $booking = new Booking($room_type, $new_arrival_date, $new_departure_date);

        $room = Room::where('room_number', $booking->available_room_number())->first();

        $room_booking->room_id = $room->id;
        $room_booking->user_id = $user->id;
        $room_booking->save();

        $room->available = 0;
        $room->save();

        Alert::success('SUCCESS','Berhasil melakukan pemesanan kamar');
        return redirect()->route('user-transaksi');
    }
}
