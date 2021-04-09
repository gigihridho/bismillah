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
                                <i class="fas fa-upload"></i>
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
        $this->validate($request, [
            'photo_payment' => 'required|image|max:2048|mimes:png,jpg',
        ]);
        $data = Transaction::where('id',Auth::user()->id)->first();
        $file = $request->file('photo_payment')->store('assets/transaction','public');
        $data->photo_payment = $file;
        $data->save();
        Alert::success('SUCCESS','Foto pembayaran berhasil disimpan');
        return redirect()->back();
        }
}
