<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Transaction;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomeController extends Controller
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
        $transactions = Transaction::where('payment',1)->get();
        return view('pages.admin.pemasukan.index',[
            'transactions' => $transactions
        ]);
    }

    public function show(){}
    public function search(Request $request){
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $transactions = Transaction::where('order_date','>=',$fromDate)
                    ->where('order_date','<=',$toDate)
                    ->where('payment',1)
                    ->get();
        return view('pages.admin.pemasukan.index',compact('transactions'));
    }

    public function pdf(){
        $now = Carbon::now();
        $transactions = Transaction::where('payment',1)->orderBy('order_date','ASC')->get();
        $total_price = Transaction::where('payment',1)->sum('total_price');

        $pdf = PDF::loadview('pages.admin.pemasukan.pemasukan_pdf',[
            'now' => $now,
            'total_price' => $total_price,
            'transactions' => $transactions
        ]);
        return $pdf->download('laporan-pemasukan.pdf');
    }
}
