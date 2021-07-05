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

    public function detail(Request $request, $id)
    {
        // $room_types = RoomType::where('id', $id)->get();
        // $price = RoomType::where('id',$id)->pluck('price');

        // $roomTypes = [];
        // foreach ($room_types as $room_type){
        //     $roomTypes[] = $room_type->id;
        // }
        // $rooms = Room::whereIn('room_type_id', $roomTypes)->get();

        $room_types = RoomType::where('id',$id)->get();
        // dd($room_types);
        $facilities = RoomType::with('facilities')->where('status',true)->get();
        return view('detail-kost', [
            'room_types' => $room_types,
            // 'price' => $price,
            // 'rooms' => $rooms,
            'facilities' => $facilities,
        ]);
    }
}
