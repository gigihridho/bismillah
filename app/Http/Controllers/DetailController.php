<?php

namespace App\Http\Controllers;

use App\RoomType;
use Illuminate\Http\Request;


class DetailController extends Controller
{

    public function detail(Request $request, $id)
    {
        $room_types = RoomType::where('id',$id)->get();
        $facilities = RoomType::with('facilities')->where('status',true)->get();
        return view('detail-kost', [
            'room_types' => $room_types,
            'facilities' => $facilities,
        ]);
    }
}
