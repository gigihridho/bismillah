<?php

namespace App\Http\Controllers;

use App\Room;
use App\Facility;
use App\RoomType;
use App\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DetailController extends Controller
{

    public function detail($slug){
        $room_types = RoomType::where('slug',$slug)->get();
        $rooms = Room::with('room_types')->where('room_type_id');
        $transactions = Transaction::with('room','user')->where('user_id',Auth::user()->id)->get();

        return view('pages.detail',[
            'room_types' => $room_types,
            'rooms' => $rooms,
            'transactions' => $transactions,
        ]);
        return view('pages.detail');
    }
}
