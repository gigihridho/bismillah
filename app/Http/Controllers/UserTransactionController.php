<?php

namespace App\Http\Controllers;

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
        if(request()->ajax()){
            $query = Transaction::with('user','room')->where('user_id', Auth::user()->id);

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($item){
                    return '
                        <div class="btn-group">
                            <a class="btn btn-info edit" href="' . route('user-transaksi-detail', $item->id) . '"  >
                                <i class="far fa-eye"></i> Detail
                            </a>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#uploadBukti" style="margin-left:5px">
                                <i class="fas fa-upload"></i>  Upload Bukti
                            </button>
                        </div>';
                })
                ->editColumn('photo_payment', function($item){
                    return $item->photo_payment ? '<img src="'. Storage::url($item->photo_payment).'" style="max-height: 50px;"/>' : '';
                })
                ->rawColumns(['action','photo_payment'])
                ->make();
        }
        return view('pages.user.user-transaksi.index');
    }

    public function detail(Request $request, $id){
        $item = Transaction::where('id',$id)->get();

        return view('pages.user.user-transaksi.detail',[
            'item' => $item,
        ]);
    }

    public function upload(Request $request){
        $item = Auth::user()->id;
        dd($item);
        $this->validate($request, [
            'photo_payment' => 'required|image|max:2000|mimes:png,jpg',
        ]);
            $file = $request->file('photo_payment');
            $nama_file = time()."_".$file->getClientOriginalName();
            $to = 'storage/transaction';
            $file->move($to, $nama_file);

            $item->save();

            Alert::success('SUCCESS','Foto pembayaran berhasil disimpan');
            return redirect()->back();
        }
}
