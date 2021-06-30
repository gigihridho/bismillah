<?php

namespace App\Http\Controllers\Admin;

use App\RoomBooking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TransController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function view()
    {
        if(request()->ajax()){
            $query = RoomBooking::with('user','room');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($item){
                    return '
                        <div class="btn-group">
                            <form action="' . route('transaksi.destroy', $item->id) . '" method="POST" style="margin-left:5px">
                            ' . method_field('delete') . csrf_field() . '
                            <button type="submit" class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                        </div>';
                })
                ->editColumn('photo_payment', function($item){
                    return $item->photo_payment ? '<img src="'. Storage::url($item->photo_payment).'" style="max-height: 50px;"/>' : '';
                })
                ->rawColumns(['action','photo_payment'])
                ->make();
        }
        return view('pages.admin.transaksi.view');
    }
}
