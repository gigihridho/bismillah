<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;

class DetailController extends Controller
{

    public function detail($slug){
        $room_types = RoomType::all();
        $room_type = RoomType::where('slug',$slug)->firstOrFail();
        $facilities = Facility::all();
        $rooms = Room::with('room_types','transactions')->where('room_type_id',$room_type->id);
        // dd($room_type, $facilities,$room_type, $rooms);
        return view('pages.detail',[
            'room_types' => $room_types,
            'facilities' => $facilities,
            'rooms' => $rooms
        ]);
        return view('pages.detail');
    }
}
