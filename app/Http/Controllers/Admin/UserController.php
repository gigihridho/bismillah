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

    // public function index(){
    //     if(request()->ajax()){
    //         $query = User::query();

    //         return Datatables::of($query)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($item){
    //                 return '
    //                 <div class="btn-group">
    //                     <a class="btn btn-sm btn-info" title="Detail" data-toggle="tooltip" data-placement="top" href="' . route('detail-user', $item->id) . '" >
    //                         <i class="far fa-eye"></i>
    //                     </a>
    //                     <form action="' . route('user.destroy', $item->id) . '" method="POST" style="margin-left:5px">
    //                         ' . method_field('delete') . csrf_field() . '
    //                         <button type="submit" class="btn btn-sm btn-danger">
    //                             <i class="far fa-trash-alt"></i> Hapus
    //                         </button>
    //                     </form>
    //                 </div>';
    //             })
    //             ->rawColumns(['action'])
    //             ->make();
    //     }
    //     return view('pages.admin.user.index');
    // }

    public function index(){
        $users = User::all();
        return view('pages.admin.user.index',[
            'users' => $users,
        ]);
    }

    public function show($id){
        $user = User::where('id',$id)->get();
        // if(request()->ajax()){
        //     $query = User::query($id);
        //     return Datatables::of($query)
        //         ->make();
        // }
        return view('pages.admin.user.detail',[
            'user' => $user,
        ]);
    }

    public function destroy($id){
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('user.index');
    }
}
