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
        $this->middleware('auth');
    }

    public function index(){
        if(request()->ajax()){
            $query = User::query();

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1"
                                    type="button" id="action' .  $data->id . '"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $data->id . '">
                                    <a class="dropdown-item btn btn-info" href="' . route('detail-user', $data->id) . '">
                                        Detail
                                    </a>

                                    <form action="' . route('user.destroy', $data->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item btn btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
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
