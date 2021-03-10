<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;


class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        if(request()->ajax()){
            $query = Transaction::with('user','room');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '
                        <div class="btn-group">
                            <a class="btn btn-info edit" href="' . route('fasilitas.edit', $data->id) . '" >
                                Belum dikonfirmasi
                            </a>
                        </div>';
                })
                ->editColumn('icon', function($data){
                    return $data->icon ? '<img src="'. Storage::url($data->icon).'" style="max-height: 50px;"/>' : '';
                })
                ->rawColumns(['action','icon'])
                ->make();
        }
        return view('pages.admin.transaksi.index');
    }

    public function create()
    {

    }
}
