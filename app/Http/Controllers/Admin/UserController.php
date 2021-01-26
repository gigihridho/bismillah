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
                ->addColumn('action', function($data){
                    return '
                    <div class="btn-group">
                        <a class="btn btn-info edit" href="' . route('dashboard', $data->id) . '" >
                            Edit
                        </a>
                        <form action="' . route('user.destroy', $data->id) . '" method="POST"  style="margin-left:10%">
                            ' . method_field('delete') . csrf_field() . '
                            <button type="submit" class="btn btn-danger">
                                Hapus
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
        $data = User::findOrFail($id);
        if(request()->ajax()){
            $query = User::query($id);

            return Datatables::of($query)
                ->addIndexColumn()
                ->make();
        }
        return view('pages.admin.user.detail',[
            'data' => $data
        ]);
    }

    public function destroy($id){
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('user.index');
    }
}
