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
        $transactions = Transaction::all();
        return view('pages.admin.booking.index',[
            'transactions' => $transactions
        ]);
    }

    public function selesai(){
        $transactions = Transaction::where('status',"Selesai")->get();
        return view('pages.admin.booking.selesai',[
            'transactions' => $transactions
        ]);
    }

    public function menunggu(){
        $transactions = Transaction::where('status',"Menunggu")->get();
        return view('pages.admin.booking.belum',[
            'transactions' => $transactions
        ]);
    }

    public function cancel(){
        $transactions = Transaction::Where('status',"Dibatalkan")->get();
        return view('pages.admin.booking.batal',[
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
            'status' => 'in:Menunggu,Selesai,Dibatalkan',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator);
        }
        if($transaction->status === 'Dibatalkan'){
            $transaction = Transaction::findOrFail($id);
            $room = Room::find($transaction->room_id);
            $room->available = 1;
            $room->save();
            $transaction->save();
        } else {
            $transaction->status = $request->input('status','Selesai');
            $transaction->save();
        }
        // Mail::to($transaction->user->email)->send(new PaymentSuccessMail());
        Alert::success('SUCCESS','Status booking telah diubah');
        return redirect()->route('transaksi');
    }

    public function detail($id){
        $transactions = Transaction::where('id',$id)->get();
        return view('pages.admin.booking.detail',[
            'transactions' => $transactions
        ]);
    }
}
