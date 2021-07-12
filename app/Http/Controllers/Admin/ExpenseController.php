<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use Carbon\Carbon;
use Barryvdh\DomPDF\PDF as pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $pengeluaran = Expense::all();
        return view('pages.admin.pengeluaran.index',[
            'pengeluaran' => $pengeluaran
        ]);
    }

    public function create(){
        return view('pages.admin.pengeluaran.create');
    }

    public function store(Request $request){
        $data = $request->all();

        Expense::create($data);
        Alert::success('SUCCESS','Data Pengeluaran Berhasil Ditambah');
        return redirect()->route('pengeluaran.index');
    }

    public function edit($id){
        $item = Expense::findOrFail($id);

        return view('pages.admin.pengeluaran.edit',[
            'item' => $item,
        ]);
    }
    public function update(Request $request,$id){
        $data = $request->all();

        $item = Expense::findOrFail($id);

        $item->update($data);
        Alert::success('SUCCESS','Data Pengeluaran Berhasil Diupdate');
        return redirect()->route('pengeluaran.index');
    }
    public function ex_pdf(){
        $now = Carbon::now();
        $pengeluaran = Expense::where('status',1)->orderBy('order_date','ASC')->get();
        $nominal = Expense::where('status',1)->sum('nominal');

        $pdf = PDF::loadview('pages.admin.transaksi.transaksi_pdf',[
            'now' => $now,
            'nominal' => $nominal,
            'pengeluaran' => $pengeluaran
        ]);
        return $pdf->download('laporan-pengeluaran.pdf');
    }

    public function destroy($id){
        $item = Expense::findOrFail($id);
        $item->delete();

        return redirect()->route('pengeluaran.index');
    }
}
