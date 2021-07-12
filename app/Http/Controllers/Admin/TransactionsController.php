<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\RoomBooking;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;


class TransactionsController extends Controller
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
        $transactions = RoomBooking::where('payment',1)->get();
        // dd($transactions);
        return view('pages.admin.transaksi.index',[
            'transactions' => $transactions
        ]);
    }
    // PDF::setOptions($this->setPdfOption())->loadView('transaksi_pdf', [
    public function pdf(){
        $now = Carbon::now();
        $transactions = RoomBooking::where('payment',1)->orderBy('order_date','ASC')->get();
        $total_price = RoomBooking::where('payment',1)->sum('total_price');

        $pdf = PDF::loadview('pages.admin.transaksi.transaksi_pdf',[
            'now' => $now,
            'total_price' => $total_price,
            'transactions' => $transactions
        ]);
        return $pdf->download('laporan-pemasukan.pdf');
    }
}
