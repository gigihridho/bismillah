<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\RoomBooking;
use App\Transaction;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserTransactionController extends Controller
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
        $transaction = Transaction::where('user_id','=',Auth::user()->id)->get();
        return view('pages.user.user-transaksi.index',[
            'transaction' => $transaction
        ]);
    }

    public function lanjut(Request $request){
        $transaction = Transaction::with('user','room')
            ->where('user_id',Auth::user()->id)
            ->latest()
            ->first();
        if ($transaction->payment == 0) {
            return redirect()->back()->withErrors('Menunggu admin melakukan konfirmasi pembayaran sebelumnya');
        }
        $room_type =  $transaction->room->room_type;

        return view('pages.user.user-transaksi.create',[
            'transaction' => $transaction,
            'room_type' => $room_type
        ]);
    }

    public function save(Request $request){
        $old_room_booking = json_decode($request->transaction);
        $new_arrival_date = $old_room_booking->departure_date;
        $duration = $request->input('duration');
        $total_price = $request->input('total');
        $kode = 'KOS'.date("ymd").mt_rand(0000,9999);

        if ($duration == 1) {
            $new_departure_date = date('Y-m-d', strtotime('+1 month', strtotime($new_arrival_date)));
        } elseif ($duration == 6){
            $new_departure_date = date('Y-m-d', strtotime('+6 month', strtotime($new_arrival_date)));
        } else {
            $new_departure_date = date('Y-m-d', strtotime('+12 month', strtotime($new_arrival_date)));
        }

        $user = Auth::user();
        $transaction = new Transaction();
        $transaction->duration = $duration;
        $transaction->arrival_date = $new_arrival_date;
        $transaction->departure_date = $new_departure_date;
        $transaction->order_date = Carbon::now();
        $transaction->total_price = $total_price;
        $transaction->room_id = $old_room_booking->room_id;
        $transaction->user_id = $user->id;
        $transaction->kode = $kode;
        if($request->hasFile('photo_payment')){
            $path = $request->file('photo_payment')->store('assets/transaction','public');
            $transaction->photo_payment = $path;
        }
        $transaction->save();

        Alert::success('SUCCESS','Berhasil melakukan perpanjangan sewa kamar');
        return redirect()->route('user-transaksi');
    }
    public function invoice($id){
        $now = Carbon::now();
        $transaction = Transaction::with('user','room')->where('id', $id)->first();
        // dd($transaction);
        $pdf = PDF::loadview('pages.user.user-transaksi.invoice_pdf',[
            'now' => $now,
            'transaction' => $transaction,
        ]);
        return $pdf->download('invoice.pdf');
    }
    public function detail(Request $request, $id){
        $transaction = Transaction::where('id',$id)->get();

        return view('pages.user.user-transaksi.detail',[
            'transaction' => $transaction,
        ]);
    }

    public function upload(Request $request,$id){
        $this->validate($request, [
            'photo_payment' => 'required|image|max:2048|mimes:png,jpg,jpeg',
        ],
        [
            'photo_payment.required' => 'Bukti pembayaran tidak boleh kosong',
            'photo_payment.max' => 'Bukti pembayaran melebihi 2MB',
            'photo_payment.mimes' => 'Format file tidak didukung'
        ]);
        $user = Auth::user();

        $transaction = Transaction::with('user','room')->where('user_id', Auth::user()->id)->latest()->first();
        if($request->hasFile('photo_payment')){
            $path = $request->file('photo_payment')->store('assets/transaction','public');
            $transaction->photo_payment = $path;
        }
        $transaction->save();

        Alert::success('SUCCESS','Bukti pembayaran berhasil disimpan');
        return redirect()->back();
    }
}
