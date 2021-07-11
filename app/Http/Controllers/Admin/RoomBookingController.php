<?php

namespace App\Http\Controllers\Admin;

use App\RoomBooking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RoomBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $room_bookings = RoomBooking::all();
        return view('pages.admin.booking.index',[
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

    public function destroy($id){
        $room_booking = RoomBooking::findOrFail($id);

        if($room_booking->room->available = true){
            $room_booking->delete();
        }
        $room_booking->status = "Menunggu";
        $room_booking->save();

        return redirect()->route('booking.index');
    }
}
