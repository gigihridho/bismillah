<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(){
        if(request()->ajax()){
            $query = User::query();

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($item){
                    return '
                    <div class="btn-group">
                        <a class="btn btn-info edit" href="' . route('detail-user', $item->id) . '" >
                            <i class="far fa-eye"></i> Detail
                        </a>
                        <form action="' . route('user.destroy', $item->id) . '" method="POST"  style="margin-left:10px">
                            ' . method_field('delete') . csrf_field() . '
                            <button type="submit" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.admin.user.index');
    }

    public function detail($id){
        $item = User::where('id',$id)->get();
        // if(request()->ajax()){
        //     $query = User::query($id);
        //     return Datatables::of($query)
        //         ->make();
        // }
        return view('pages.admin.user.detail',[
            'item' => $item,
        ]);
    }

    public function destroy($id){
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('user.index');
    }
}
