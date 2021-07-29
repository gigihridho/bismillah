<?php

namespace App\Http\Controllers;

use App\Mail\BookedMail;
use App\Room;
use App\Rules\Booking;
use App\RoomType;
use App\RoomBooking;
use App\Rules\RoomAvailableRule;
use App\Transaction;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $kode = 'KOS'.date("ymd").mt_rand(0000,9999);

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
            'room_type_id' => $room_type_id,'new_arrival_date' => $new_arrival_date,
            'new_departure_date' => $new_departure_date,'room_type' => $room_type,
            'room_number' => $booking->available_room_number(),'duration' => $duration,
            'total_price' => $total_price,
            'kode' => $kode,
        ]);
    }

    public function booking(Request $request, $room_type_id){
        $rules = [
            'arrival_date' => 'required|date|after_or_equal:today',
        ];
        $room_type = RoomType::findOrFail($room_type_id);
        $new_arrival_date = $request->input('arrival_date');
        $duration = $request->input('duration');
        $kode = 'KOS'.date("ymd").mt_rand(0000,9999);

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

        $transaction = new Transaction();
        $user = Auth::user();
        $transaction->kode = $kode;
        $transaction->arrival_date = $request->input('arrival_date');
        $transaction->departure_date = $new_departure_date;
        $transaction->order_date = Carbon::now();

        $price = $room_type->price;
        if($duration == 1){
            $total_price = $duration * $price;
        } elseif($duration == 6){
            $total_price = $duration * $price - (0.5 * $price);
        } elseif($duration == 12){
            $total_price = $duration * $price - (1 * $price);
        }

        $transaction->total_price = $total_price;
        $transaction->user_id = $user->id;

        $booking = new Booking($room_type, $new_arrival_date, $new_departure_date);

        $room = Room::where('room_number', $booking->available_room_number())->first();

        $transaction->room_id = $room->id;
        $transaction->user_id = $user->id;
        $transaction->save();

        $room->available = 0;
        $room->save();
        Alert::success('SUCCESS','Berhasil melakukan pemesanan kamar');
        return redirect()->route('upload');
    }

    public function show(){
        $transaction = Transaction::with('user','room')->where('user_id',Auth::user()->id)->latest()->first();
        return view('pages.unggah',[
            'transaction' => $transaction
        ]);
    }

    public function upload(Request $request, $id){
        $this->validate($request, [
            'photo_payment' => 'required|image|max:2048|mimes:png,jpg,jpeg',
        ],
        [
            'photo_payment.required' => 'Bukti pembayaran tidak boleh kosong',
            'photo_payment.max' => 'Bukti pembayaran melebihi 2MB',
            'photo_payment.mimes' => 'Format file tidak didukung'
        ]);

        $transaction = Transaction::with('user','room')->where('user_id',Auth::user()->id)->latest()->first();
        if($request->hasFile('photo_payment')){
            $path = $request->file('photo_payment')->store('assets/transaction','public');
            $transaction->photo_payment = $path;
        }
        $transaction->save();

        Alert::success('SUCCESS','Foto pembayaran berhasil disimpan');
        return redirect()->route('user-transaksi');
    }
}
