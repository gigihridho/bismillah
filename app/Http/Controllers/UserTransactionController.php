<?php

namespace App\Http\Controllers;

use App\RoomBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $transaction = RoomBooking::with('user','room')
            ->where('user_id',Auth::user()->id)->get();
        return view('pages.user.user-transaksi.index',[
            'transaction' => $transaction
        ]);
    }

    public function lanjut(Request $request){
        $transaction = RoomBooking::with('user','room')
            ->where('user_id',Auth::user()->id)
            ->latest()
            ->first();
        if ($transaction->payment == 0) {
            return redirect()->back()->withErrors('Silahkan konfirmasi pembayaran terlebih dahulu');
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

        if ($duration == 1) {
            $new_departure_date = date('Y-m-d', strtotime('+1 month', strtotime($new_arrival_date)));
        } elseif ($duration == 6){
            $new_departure_date = date('Y-m-d', strtotime('+6 month', strtotime($new_arrival_date)));
        } else {
            $new_departure_date = date('Y-m-d', strtotime('+12 month', strtotime($new_arrival_date)));
        }

        $user = Auth::user();
        $room_booking = new RoomBooking();
        $room_booking->duration = $duration;
        $room_booking->arrival_date = $new_arrival_date;
        $room_booking->departure_date = $new_departure_date;
        $room_booking->order_date = Carbon::now();
        $room_booking->total_price = $total_price;
        $room_booking->room_id = $old_room_booking->room_id;
        $room_booking->user_id = $user->id;
        if($request->hasFile('photo_payment')){
            $path = $request->file('photo_payment')->store('assets/transaction','public');
            $room_booking->photo_payment = $path;
        }
        $room_booking->save();

        Alert::success('SUCCESS','Berhasil melakukan perpanjangan sewa kamar');
        return redirect()->route('user-transaksi');
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
        // $transaction->room->availability = $request->availability(true);
        $transaction->delete();

        Alert::success('Sukses','Data berhasil dihapus');
        return redirect()->route('user-transaksi');
        }
}
