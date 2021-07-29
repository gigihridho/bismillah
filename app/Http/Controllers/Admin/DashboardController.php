<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use App\User;
use App\Expense;
use App\RoomBooking;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Transaction;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $user = User::role('user')->count();
        $room_avail = Room::where('available',true)->count();
        $rom = Room::count();
        $transactions = Transaction::count();
        $total_price = Transaction::where('payment',1)->sum('total_price');
        $pengeluaran = Expense::where('status',1)->sum('nominal');
        $keuntungan = $total_price - $pengeluaran;
        $label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        for($bulan = 1 ; $bulan < 12; $bulan++){
            $chart = collect(DB::select("SELECT count(id) as jumlah from transactions where month(created_at)='$bulan'"))->first();
            $jumlah_transactions[] = $chart->jumlah;
        }
        return view('pages.admin.dashboard',[
            'user' => $user,
            'room_avail' => $room_avail,
            'label' => $label,
            'transactions' => $transactions,
            'jumlah_transactions' => $jumlah_transactions,
            'total_price' => $total_price,
            'keuntungan' => $keuntungan,
            'pengeluaran' => $pengeluaran,
            'rom' => $rom,
        ]);
    }
}
