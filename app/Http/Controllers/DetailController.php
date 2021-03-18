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

class DetailController extends Controller
{

    public function detail(Request $request, $slug)
    {
        // $room_typess = RoomType::where('slug',$slug)->pluck('id');
        $room_types = RoomType::where('slug', $slug)->get();
        $price = RoomType::where('slug',$slug)->pluck('price');
        // $roomm = Room::with('room_type','user')->where('room_type_id', $room_types->id)->get();
        $rooms = DB::table('room_types')
            ->join('rooms', 'room_types.id', '=', 'rooms.room_type_id')
            ->where('room_types.id',1)
            ->get();

        $facilities = Facility::all();
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
            'arrival_date' => 'required|date',
            'duration' => 'required|integer'
        ]);
        $duration = $request->duration;

        if($duration == 1){
            $departure_date = date('Y-m-d', strtotime('+1 month', strtotime($request->arrival_date)));
        }elseif($duration == 6){
            $departure_date = date('Y-m-d', strtotime('+6 month', strtotime($request->arrival_date)));
        }else {
            $departure_date = date('Y-m-d', strtotime('+12 month', strtotime($request->arrival_date)));
        }

        $price = RoomType::where('id',$request->room)->pluck('price');
        if($duration == 1){
            $total_price = $duration * $price[0];
        } elseif($duration == 6){
            $total_price = $duration * $price[0] - (0.1 * $duration * $price[0]);
        } elseif($duration == 12){
            $total_price = $duration * $price[0] - (0.2 * $duration * $price[0]);
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
        return redirect()->route('user-transaksi.index');
    }
}
