<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use Illuminate\Http\Request;
use App\Mail\PaymentSuccessMail;
use App\Http\Controllers\Controller;
use App\Kamar;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    public function index(){
        $pemesanans = Booking::all();
        return view('pages.admin.booking.index',[
            'pemesanans' => $pemesanans
        ]);
    }

    public function selesai(){
        $pemesanans = Booking::where('status',"Selesai")->get();
        return view('pages.admin.booking.selesai',[
            'pemesanans' => $pemesanans
        ]);
    }

    public function menunggu(){
        $pemesanans = Booking::where('status',"Menunggu")->get();
        return view('pages.admin.booking.menunggu',[
            'pemesanans' => $pemesanans
        ]);
    }

    public function cancel(){
        $pemesanans = Booking::Where('status',"Dibatalkan")->get();
        return view('pages.admin.booking.batal',[
            'pemesanans' => $pemesanans
        ]);
    }

    public function edit($id){
        $pemesanans = Booking::findOrFail($id);
        return view('pages.admin.booking.edit',[
            'pemesanans' => $pemesanans
        ]);
    }
    public function status(Request $request, $id){
        $pemesanans = Booking::findOrFail($id);
        $pemesanans->status = "Selesai";
        $pemesanans->save();
        Alert::success('SUCCESS','Data booking telah dikonfirmasi');
        return redirect()->route('transaksi');
    }
    public function batal(Request $request, $id){
        $pemesanans = Booking::findOrFail($id);
        $kamar = Kamar::find($pemesanans->kamar_id);
        $pemesanans->status = "Dibatalkan";
        $kamar->status = 1;
        $kamar->save();
        $pemesanans->save();
        Alert::success('SUCCESS','Data booking telah dibatalkan');
        return redirect()->route('transaksi');
    }


    public function update(Request $request, $id){
        $pemesanans = Booking::findOrFail($id);

        $rules = [
            'status' => 'in:PENDING,SUCCESS,CANCELLED',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator);
        }
        if($pemesanans->status === 'CANCELLED'){
            $pemesanans = Booking::findOrFail($id);
            $kamar = Kamar::find($pemesanans->kamar_id);
            $kamar->tersedia = 1;
            $kamar->save();
            $pemesanans->save();
        } else {
            $pemesanans->status = $request->input('status','SUCCESS');
            $pemesanans->save();
        }
        // Mail::to($transaction->user->email)->send(new PaymentSuccessMail());
        Alert::success('SUCCESS','Status booking telah diubah');
        return redirect()->route('transaksi');
    }

    public function detail($id){
        $pemesanans = Booking::where('id',$id)->get();
        return view('pages.admin.booking.detail',[
            'pemesanans' => $pemesanans
        ]);
    }
}
