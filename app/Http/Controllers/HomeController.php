<?php

namespace App\Http\Controllers;

use App\Review;
use App\RoomType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $reviews = Review::all();
        $room_types = RoomType::where('status',1)->get();
        $rooms = RoomType::with('rooms')->where('status',true)->get();
        return view('landing',[
            'users' => $users,
            'reviews' => $reviews,
            'room_types' => $room_types,
            'rooms' => $rooms
        ]);
    }
}
