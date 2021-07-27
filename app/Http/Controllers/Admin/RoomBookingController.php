<?php

namespace App\Http\Controllers\Admin;

use App\RoomBooking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class RoomBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $room_bookings = RoomBooking::where('payment',1)->get();
        return view('pages.admin.booking.index',[
            'room_bookings' => $room_bookings
        ]);
    }

    public function belum(){
        $room_bookings = RoomBooking::where('payment',0)->get();
        return view('pages.admin.booking.belum',[
            'room_bookings' => $room_bookings
        ]);
    }


    public function edit($id){
        $room_booking = RoomBooking::findOrFail($id);
        return view('pages.admin.booking.edit',[
            'room_booking' => $room_booking
        ]);
    }

    public function update(Request $request, $id){
        $room_booking = RoomBooking::findOrFail($id);

        $rules = [
            'status' => 'in:Menunggu,Terisi,Keluar',
            'payment' => 'boolean',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator);
        }

        $room_booking->payment = $request->input('payment');
        $room_booking->status = $request->input('status');
        $room_booking->save();

        Alert::success('SUCCESS','Transaksi telah dikonfirmasi');
        return redirect()->route('booking.index');
    }

    public function detail($id){
        $room_bookings = RoomBooking::where('id',$id)->get();
        return view('pages.admin.booking.detail',[
            'room_bookings' => $room_bookings
        ]);
    }

    public function destroy($id){
        $room_booking = RoomBooking::findOrFail($id);
        dd($room_booking);

        $room_booking->delete();
        return redirect()->back();
    }
}
