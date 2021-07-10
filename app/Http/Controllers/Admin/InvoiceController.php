<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use App\User;
use App\RoomType;
use Carbon\Carbon;
use App\RoomBooking;
use App\Rules\Booking;
use Illuminate\Http\Request;
use App\Rules\RoomAvailableRule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $invoices = RoomBooking::all();
        return view('pages.admin.invoice.index',[
            'invoices' => $invoices
        ]);
    }

    public function create($user_id){
        $invoice = RoomBooking::findOrFail($user_id);
        dd($invoice);
        return view('pages.admin.invoice.create',[
            'invoice' => $invoice
        ]);
    }

    public function store(Request $request, $room_type_id)
    {
        $user_id = $request->input('user_id');
        $data = RoomBooking::join('users','room_bookings.user_id','=','users.id')
            ->where('users.id', '=' ,$user_id)
            ->select('users.*')
            ->getQuery()
            ->get();

        $room_type = RoomType::findOrFail($room_type_id);

        $duration = $request->input('duration');
        $old_arrival_date = Carbon::parse($data->arrival_date);
        $old_departure_date = Carbon::parse($data->departure_date);

        if($duration == 1){
            $new_arrival_date = date('Y-m-d', strtotime('+1 month', strtotime($old_arrival_date)));
        }elseif($duration == 6){
            $new_arrival_date = date('Y-m-d', strtotime('+6 month', strtotime($old_arrival_date)));
        }else {
            $new_arrival_date = date('Y-m-d', strtotime('+12 month', strtotime($old_arrival_date)));
        }

        if($duration == 1){
            $new_departure_date = date('Y-m-d', strtotime('+1 month', strtotime($old_departure_date)));
        }elseif($duration == 6){
            $new_departure_date = date('Y-m-d', strtotime('+6 month', strtotime($old_departure_date)));
        }else {
            $new_departure_date = date('Y-m-d', strtotime('+12 month', strtotime($old_departure_date)));
        }
        // $rules['booking_validation'] = [new RoomAvailableRule($room_type,$new_arrival_date,$new_departure_date)];

        // $validator = Validator::make($request->all(), $rules);
        // if($validator->fails()){
        //     return redirect()->back()
        //     ->withInput($request->all())
        //         ->withErrors($validator);
        // }

        $booking = new RoomBooking();

        $booking->arrival_date = $new_arrival_date;
        $booking->departure_date = $new_departure_date;
        $booking->order_date = Carbon::now();

        $price = $room_type->price;

        if($duration == 1){
            $total_price = $duration * $price;
        } elseif($duration == 6){
            $total_price = $duration * $price - (0.5 * $price);
        } elseif($duration == 12){
            $total_price = $duration * $price - (1 * $price);
        }

        $booking->total_price = $total_price;

        $booked = new Booking($room_type, $new_arrival_date, $new_departure_date);

        $room = Room::where('room_number', $booked->available_room_number())->first();

        $booking->room_id = $room->id;
        $booking->user_id = $data->id;

        $booking->save();

        Alert::success('SUCCESS','Data Booking Berhasil Ditambah');
        return redirect()->route('booking.index');
    }
}
