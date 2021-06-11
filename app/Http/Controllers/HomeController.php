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
        return view('pages.home',[
            'users' => $users,
            'reviews' => $reviews
        ]);
    }
}
