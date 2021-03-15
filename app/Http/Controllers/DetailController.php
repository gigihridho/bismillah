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

}
