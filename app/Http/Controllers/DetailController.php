<?php

namespace App\Http\Controllers;

use App\Room;
use App\Facility;
use App\RoomType;
use Carbon\Carbon;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DetailController extends Controller
{

    public function detail(Request $request, $slug)
    {
        $room_types = RoomType::where('slug', $slug)->get();
        $price = RoomType::where('slug',$slug)->pluck('price');

        $roomTypes = [];
        foreach ($room_types as $room_type){
            $roomTypes[] = $room_type->id;
        }
        $rooms = Room::whereIn('room_type_id', $roomTypes)->get();

        $facilities = RoomType::with('facilities')->where('id','room_type_id')->get();
        return view('pages.detail', [
            'room_types' => $room_types,
            'price' => $price,
            'rooms' => $rooms,
            'facilities' => $facilities,
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'room' => 'required|exists:rooms,id',
            'arrival_date' => 'required|date|after_or_equal:today',
            'duration' => 'required|integer'
        ],[
            'room.required' => 'Kamar tidak boleh kosong',
            'arrival_date.required' => 'Tanggal masuk tidak boleh kosong',
            'duration.required' => 'Lama waktu sewa tidak boleh kosong'
        ]);

        $duration = $request->duration;

        if($duration == 1){
            $departure_date = date('Y-m-d', strtotime('+1 month', strtotime($request->arrival_date)));
        }elseif($duration == 6){
            $departure_date = date('Y-m-d', strtotime('+6 month', strtotime($request->arrival_date)));
        }else {
            $departure_date = date('Y-m-d', strtotime('+12 month', strtotime($request->arrival_date)));
        }
        $room = Room::find($request->room);
        $price = $room->room_type->price;

        if($duration == 1){
            $total_price = $duration * $price;
        } elseif($duration == 6){
            $total_price = $duration * $price - (0.1 * $duration * $price[0]);
        } elseif($duration == 12){
            $total_price = $duration * $price - (0.2 * $duration * $price[0]);
        }

        $data = [
            'user_id' => Auth::user()->id,
            'room_id' => $request->room,
            'order_date' => Carbon::now(),
            'total_price' => $total_price,
            'arrival_date' => $request->arrival_date,
            'departure_date' => $departure_date,
            'duration' => $duration,
            'status' => 'Belum Konfirmasi',
        ];

        Transaction::create($data);
        return redirect()->route('user-transaksi');
    }
}
