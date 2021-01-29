<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth']);
    // }

    public function detail(Request $request, $id){
        $rooms = Room::with('room_types')->where('slug',$id)->firstOrFail();
        $room_types = RoomType::with('facilities:name')->get();
        $facilities = Facility::all();
        return view('pages.detail',[
            'room_types' => $room_types,
            'facilities' => $facilities,
            'rooms' => $rooms
        ]);
    }
}
