<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\RoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user = User::role('user')->get()->count();
        $transactions = RoomBooking::where('status','Konfirmasi')->count();
        $label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        for($bulan = 1 ; $bulan < 12; $bulan++){
            $chart = collect(DB::select("SELECT count(id) as jumlah from bookings where month(created_at)='$bulan'"))->first();
            $jumlah_transactions[] = $chart->jumlah;
        }
        $total_price = DB::table('bookings')->sum('total_price');
        return view('pages.admin.dashboard',[
            'user' => $user,
            'label' => $label,
            'transactions' => $transactions,
            'jumlah_transactions' => $jumlah_transactions,
            'total_price' => $total_price,
        ]);
    }
}
