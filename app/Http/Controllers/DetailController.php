<?php

namespace App\Http\Controllers;

use App\Room;
use App\Facility;
use App\RoomType;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{

    public function detail(Request $request, $slug)
    {
        $room_types = RoomType::where('slug', $slug)->get();
        $room = DB::table('room_types')->select('room_types.*','room_types.id as room_types_id');
        $rooms = DB::table('room_types')
            ->join('rooms', 'room_types.id', '=', 'rooms.room_type_id')
            ->where('room_types.id',2)
            ->get();
        // dd($rooms);
        //SELECT * FROM `room_types` INNER JOIN rooms ON room_types.id = rooms.room_type_id WHERE room_types.id = 2
        $facilities = Facility::all();
        return view('pages.detail', [
            'room_types' => $room_types,
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
            $departure_date = Carbon::now()->addMonth();
        }elseif($duration == 6){
            $departure_date = Carbon::now()->addMonth(6);
        }else {
            $departure_date = Carbon::now()->addYear();
        }
        $price = $request->price;
        $total_price = $price * $duration;
        $data = [
            'user_id' => Auth::user()->id,
            'room_id' => $request->room,
            'order_date' => Carbon::now(),
            'total_price' => 400000,
            'arrival_date' => $request->arrival_date,
            'departure_date' => $departure_date,
            'duration' => $duration,
            'status' => 'Belum Konfirmasi',
        ];
        DB::table('transactions')->insert($data);
        return redirect()->route('user-transaksi.index');
    }
}
