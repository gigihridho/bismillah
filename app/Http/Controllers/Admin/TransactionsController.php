<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use App\Transaction;
use Illuminate\Http\Request;
use App\Mail\PaymentSuccessMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
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
            'status' => 'in:Menunggu,Terisi',
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
        Mail::to($transaction->user->email)->send(new PaymentSuccessMail());
        Alert::success('SUCCESS','Transaksi telah dikonfirmasi');
        return redirect()->route('sudah-bayar');
    }

    public function batal(Request $request,$id){
        $transaction = Transaction::findOrFail($id);
        $room = Room::where('id',$id)->first();
        // $transaction->status = 0;
        $room->available = 1;
        // dd($transaction);
        $transaction->save();
        $room->save();
        Alert::success('SUCCESS','Transaksi telah dikonfirmasi');
        return redirect()->route('belum-dibayar');
    }

    public function detail($id){
        $transactions = Transaction::where('id',$id)->get();
        return view('pages.admin.booking.detail',[
            'transactions' => $transactions
        ]);
    }
}
