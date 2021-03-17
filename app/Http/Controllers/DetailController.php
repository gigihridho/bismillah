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

    public function detail(Request $request, $id)
    {
        $room_typess = RoomType::all();
        $room_types = RoomType::where('slug', $id)->firstOrFail();
        dd($room_types);
        $roomm = Room::with('room_type','user')->where('room_type_id', $room_types->id)->get();

        $rooms = DB::table('room_types')
            ->join('rooms', 'room_types.id', '=', 'rooms.room_type_id')
            ->where('room_types.id',1)
            ->get();
        //SELECT * FROM `room_types` INNER JOIN rooms ON room_types.id = rooms.room_type_id WHERE room_types.id = 2
        $facilities = Facility::all();
        return view('pages.detail', [
            'room_typess' => $room_typess,
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
