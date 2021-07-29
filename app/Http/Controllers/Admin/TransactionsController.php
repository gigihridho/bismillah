<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends Controller
{
    public function index(){
        $transactions = Transaction::where('payment',1)->get();
        return view('pages.admin.booking.index',[
            'transactions' => $transactions
        ]);
    }

    public function belum(){
        $transactions = Transaction::where('payment',0)->get();
        return view('pages.admin.booking.belum',[
            'transactions' => $transactions
        ]);
    }

    public function edit($id){
        $transaction = Transaction::findOrFail($id);
        return view('pages.admin.booking.edit',[
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request, $id){
        $transaction = Transaction::findOrFail($id);

        $rules = [
            'status' => 'in:Menunggu,Terisi,Keluar',
            'payment' => 'boolean',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator);
        }

        $transaction->payment = $request->input('payment');
        $transaction->status = $request->input('status');
        $transaction->save();

        Alert::success('SUCCESS','Transaksi telah dikonfirmasi');
        return redirect()->route('sudah-bayar');
    }

    public function detail($id){
        $transactions = Transaction::where('id',$id)->get();
        return view('pages.admin.booking.detail',[
            'transactions' => $transactions
        ]);
    }

    // public function destroy($id){
    //     $room_booking = RoomBooking::findOrFail($id);
    //     dd($room_booking);

    //     $room_booking->delete();
    //     return redirect()->back();
    // }
}
