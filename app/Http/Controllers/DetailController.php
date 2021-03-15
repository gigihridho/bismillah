<?php

namespace App\Http\Controllers;

use App\Room;
use App\Facility;
use App\RoomType;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{

    public function detail(Request $request, $slug){
        $room_types = RoomType::where('slug',$slug)->get();
        $rooms = DB::table('room_types')
        ->join('rooms', 'room_types.id', '=' ,'rooms.room_type_id')
        ->where('room_types.id',1)
        ->get();
//        SELECT * FROM `room_types` INNER JOIN rooms ON room_types.id = rooms.room_type_id WHERE room_types.id = 2
        $facilities = Facility::all();
        return view('pages.detail',[
            'room_types' => $room_types,
            'rooms' => $rooms,
            'facilities' => $facilities
        ]);
    }

    public function add(Request $request){
        $request->validate([
            'user_id' => 'required|exists:user,id',
            'room_id' => 'required|exists:rooms,id',
            'price' => 'required|number',
            'duration' => 'required|integer',
            'arrival_date' => 'required|date',
            'status' => 'required'
        ]);
        dd($request)->all();
        $transaction = Transaction::create([
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'order_date' => $request->order_date,
            'price' => $request->price,
            'duration' => $request->duration,
            'arrival_date' => $request->arrival_date,
            'departure_date' => $request->departure_date,
            'status' => $request->status
        ]);
        dd($transaction);
        Transaction::with(['user','room'])->find($transaction->id);

        return redirect()->route('home');
    }

}
