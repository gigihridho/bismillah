<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\RoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Room;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user = RoomBooking::with('user')->where('payment',1)->count();
        $room = Room::count();
        $transactions = RoomBooking::where('payment',1)->count();
        $total_price = RoomBooking::where('payment',1)->sum('total_price');
        $label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        for($bulan = 1 ; $bulan < 12; $bulan++){
            $chart = collect(DB::select("SELECT count(id) as jumlah from room_bookings where month(created_at)='$bulan'"))->first();
            $jumlah_transactions[] = $chart->jumlah;
        }

        return view('pages.admin.dashboard',[
            'user' => $user,
            'room' => $room,
            'label' => $label,
            'transactions' => $transactions,
            'jumlah_transactions' => $jumlah_transactions,
            'total_price' => $total_price,
        ]);
    }
}
