<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
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
                ->addColumn('action', function($item){
                    return '
                        <div class="btn-group">
                            <form action="'. route('confirmation',$item->id).'" enctype="multipart/form-data">
                                '.method_field('PUT') .csrf_field() .'
                            <button value="Konfirmasi" id="status" name="status" type="submit" class="btn btn-info success"
                                onclick="return confirm("Anda yakin ingin mengkonfirmasi pendaftaran ini?")">
                                Konfirmasi
                            </button>
                            </form>
                            <form action="' . route('transaksi.destroy', $item->id) . '" method="POST" style="margin-left:5px">
                            ' . method_field('delete') . csrf_field() . '
                            <button type="submit" class="btn btn-danger">
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
        return view('pages.admin.transaksi.index');
    }

    public function confirmation(Request $request, $id){
        $data = Transaction::where('id',$id)->first();
        $data->status = $request->status;
        $data->save();
        Alert::success('SUCCESS','Transaksi telah dikonfirmasi');
        return redirect()->route('transaksi.index');

    }

    public function destroy($id){
        $item = Transaction::findOrFail($id);
        $item->delete();
        return redirect()->route('transaksi.index');
    }
}
