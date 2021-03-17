<?php

namespace App\Http\Controllers;

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
                ->addColumn('action', function($data){
                    return '
                        <div class="btn-group">
                            <a class="btn btn-info edit" href="' . route('fasilitas.edit', $data->id) . '"  >
                                <i class="far fa-eye"></i> Detail
                            </a>
                            <a class="btn btn-success upload" href="' . route('fasilitas.edit', $data->id) . '" style="margin-left:3px"
                            data-toggle
                            >
                                <i class="fas fa-upload"></i> Detail
                            </a>
                        </div>';
                })
                ->editColumn('photo_payment', function($data){
                    return $data->photo_payment ? '<img src="'. Storage::url($data->photo_payment).'" style="max-height: 50px;"/>' : '';
                })
                ->rawColumns(['action','photo_payment'])
                ->make();
        }
        return view('pages.user.user-transaksi.index');
    }

    public function create(){
        return view('pages.user.user-transaksi.create');
    }

    public function detail(Request $request){
        return view('pages.user.user-transaksi.detail');
    }
}
