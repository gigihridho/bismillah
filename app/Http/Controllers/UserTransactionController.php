<?php

namespace App\Http\Controllers;

use App\User;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;


class UserTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        if(request()->ajax()){
            $query = Transaction::with('user','room');
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($item){
                    return '
                        <div class="btn-group">
                            <a class="btn btn-info edit" href="' . route('user-transaksi-detail', $item->id) . '"  >
                                <i class="far fa-eye"></i> Detail
                            </a>
                            <a class="btn btn-success upload" href="' . route('user-transaksi-upload', $item->id) . '" style="margin-left:3px"
                            data-toggle
                            >
                                <i class="fas fa-upload"></i> Upload Bukti
                            </a>
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

    public function create(){
        return view('pages.user.user-transaksi.create');
    }

    public function detail(Request $request, $id){
        $item = Transaction::where('id',$id)->get();
        // dd($item);
        // if(request()->ajax()){
        //     $query = Transaction::query($id)->with('user','room');
        //     dd($query);
        //     return Datatables::of($query)
        //         ->make();
        // }
        return view('pages.user.user-transaksi.detail',[
            'item' => $item,
        ]);
    }
}
