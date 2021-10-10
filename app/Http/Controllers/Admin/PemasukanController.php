<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Booking;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PemasukanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    protected function setPdfOption()
    {
        return [
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ];
    }

    public function index(){
        $transaksis = Booking::where('transaction_status',"SUCCESS")->get();
        return view('pages.admin.pemasukan.index',[
            'transaksis' => $transaksis
        ]);
    }

    public function show(){}
    public function search(Request $request){
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $transactions = Booking::where('order_date','>=',$fromDate)
                    ->where('order_date','<=',$toDate)
                    ->where('transaction_status',"SUCCESS")
                    ->get();
        return view('pages.admin.pemasukan.index',compact('transactions'));
    }

    public function pdf(){
        $now = Carbon::now();
        $transaksis = Booking::where('transaction_status',"SUCCESS")->orderBy('tanggal_pesan','ASC')->get();
        $total_harga = Booking::where('transaction_status',"SUCCESS")->sum('total_harga');

        $pdf = PDF::loadview('pages.admin.pemasukan.pemasukan_pdf',[
            'now' => $now,
            'total_harga' => $total_harga,
            'transaksis' => $transaksis
        ]);
        return $pdf->download('laporan-pemasukan.pdf');
    }
}
