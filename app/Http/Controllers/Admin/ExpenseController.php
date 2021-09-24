<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\ExpenseRequest;
use App\Http\Requests\Admin\ExpenseEditRequest;

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

    public function store(ExpenseRequest $request){
        $data = new Expense();
        $data->description = $request->input('description');
        $data->nominal = $request->input('nominal');
        $data->date = $request->input('date');
        $data->photo = $request->file('photo')->store('assets/expenses','public');
        $data->save();

        Alert::success('SUCCESS','Data Pengeluaran Berhasil Ditambah');
        return redirect()->route('pengeluaran.index');
    }

    public function edit($id){
        $data = Expense::findOrFail($id);

        return view('pages.admin.pengeluaran.edit',[
            'data' => $data,
        ]);
    }
    public function update(ExpenseEditRequest $request,$id){
        $data = Expense::where('id',$id)->first();
        $data->description = $request->description;
        $data->nominal = $request->nominal;
        $data->date = $request->date;
        if(request()->hasFile('photo')){
            $photo = request()->file('photo')->store('assets/expenses','public');
            $data->update(['photo' => $photo]);
        }
        $data->save();
        Alert::success('SUCCESS','Data Pengeluaran Berhasil Diupdate');
        return redirect()->route('pengeluaran.index');
    }
    public function ex_pdf(){
        $now = Carbon::now();
        $description = Expense::orderBy('date','ASC')->get();
        $nominal = Expense::sum('nominal');

        $pdf = PDF::loadview('pages.admin.pengeluaran.pengeluaran_pdf',[
            'now' => $now,
            'description' => $description,
            'nominal' => $nominal
        ]);
        return $pdf->download('laporan-pengeluaran.pdf');
    }

    public function destroy($id){
        $item = Expense::findOrFail($id);
        $item->delete();

        return redirect()->route('pengeluaran.index');
    }
}
