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

    // public function index(){
    //     if(request()->ajax()){
    //         $query = RoomBooking::with('user','room')->where('user_id', Auth::user()->id);

    //         return Datatables::of($query)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($item){
    //                 return '
    //                     <div class="btn-group">
    //                         <a class="btn btn-info btn-sm edit" href="' . route('user-transaksi-detail', $item->id) . '"  >
    //                             <i class="far fa-eye"></i> Detail
    //                         </a>
    //                         <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#uploadBukti" style="margin-left:5px">
    //                             <i class="fas fa-upload"></i>
    //                         </button>
    //                     </div>';
    //             })
    //             ->editColumn('photo_payment', function($item){
    //                 return $item->photo_payment ? '<img src="'. Storage::url($item->photo_payment).'" style="max-height: 50px;"/>' : '';
    //             })
    //             ->rawColumns(['action','photo_payment'])
    //             ->make();
    //     }
    //     return view('pages.user.user-transaksi.index');
    // }

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
        $this->validate($request, [
            'photo_payment' => 'required|image|max:2048|mimes:png,jpg,jpeg',
        ],
        [
            'photo_payment.required' => 'Bukti pembayaran tidak boleh kosong',
            'photo_payment.max' => 'Bukti pembayaran melebihi 2MB',
            'photo_payment.mimes' => 'Format file tidak didukung'
        ]);
        if($data == RoomBooking::where('id',$id)->first()){
            $file = $request->file('photo_payment')->store('assets/transaction','public');
            $data->save();
        }
        // $data = new RoomBooking();
        // $data->import($file);

        Alert::success('SUCCESS','Foto pembayaran berhasil disimpan');
        return redirect()->back();
        }

    public function destroy($id){
        $item = RoomBooking::where('booking_id',$id)->exist();

        if($item){
            Alert::warning('Gagal','Data Transaksi tidak bisa dihapus');
        }else{
            $transaction = RoomBooking::findOrFail($id);
            $transaction->delete();
            Alert::success('Sukses','Data berhasil dihapus');
        }
    }
}
