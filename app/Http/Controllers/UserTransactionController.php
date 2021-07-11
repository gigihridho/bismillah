<?php

namespace App\Http\Controllers;

use App\Booking;
use App\RoomBooking;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;


class UserTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $transaction = RoomBooking::with('user','room')->where('user_id',Auth::user()->id)->get();
        return view('pages.user.user-transaksi.index',[
            'transaction' => $transaction
        ]);
    }

    public function detail(Request $request, $id){
        $item = RoomBooking::where('id',$id)->get();

        return view('pages.user.user-transaksi.detail',[
            'item' => $item,
        ]);
    }

    public function upload(Request $request,$id){
        $transaction = RoomBooking::where('id',$id)->first();
        $this->validate($request, [
            'photo_payment' => 'required|image|max:2048|mimes:png,jpg,jpeg',
        ],
        [
            'photo_payment.required' => 'Bukti pembayaran tidak boleh kosong',
            'photo_payment.max' => 'Bukti pembayaran melebihi 2MB',
            'photo_payment.mimes' => 'Format file tidak didukung'
        ]);

        if($request->hasFile('photo_payment')){
            $path = $request->file('photo_payment')->store('assets/transaction','public');
            $transaction->photo_payment = $path;
        }
        $transaction->save();

        Alert::success('SUCCESS','Foto pembayaran berhasil disimpan');
        return redirect()->back();
        }

    public function cancel(Request $request, $id){

        $transaction = RoomBooking::findOrFail($id);
        $transaction->room->availability = $request->availability(true);
        // $transaction->delete();
        if($transaction->payment == true){
            return back()->withErrors('Maaf Anda tidak bisa membatalkan pesanan yang telah dibayar. Silakan hubungi admin');
        }

        if($transaction->status == "Terisi"){
            return back()->withErrors('Maaf Anda tidak bisa membatalkan pesanan yang telah dibayar. Silakan hubungi admin');
        }
        if($transaction->status == "Keluar"){
            return back()->withErrors('Maaf Anda tidak bisa membatalkan pesanan yang telah dibayar. Silakan hubungi admin');
        }
        if($transaction->status == "Menunggu"){
            return back()->withErrors('Maaf Anda tidak bisa membatalkan pesanan yang telah dibayar. Silakan hubungi admin');
        }

        $transaction->status = "Menunggu";

        $transaction->save();

        Alert::success('Sukses','Data berhasil dihapus');
        return redirect()->route('user-transaksi');
        }
}
