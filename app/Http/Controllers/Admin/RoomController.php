<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if(request()->ajax()){
            $query = Room::with('room_type');

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
                                    <a class="dropdown-item" href="' . route('kamar.edit', $data->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('kamar.destroy', $data->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
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

        return view('pages.admin.kamar.index');
    }

    public function edit($id){
        $data = Room::findOrFail($id);

        $room_types = RoomType::all();

        return view('pages.admin.kamar.edit',[
            'data' => $data,
            'room_types' => $room_types
        ]);
    }

    public function create(){
        $room_types = RoomType::all();

        return view('pages.admin.kamar.create',[
            'room_types' => $room_types
        ]);
    }

    public function store(Request $request){
        $data = $request->all();

        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['status'] = $request->status;

        Room::create($data);
        return redirect()->route('kamar.index');
    }

    public function destroy($id){
        $data = Room::findOrFail($id);
        $data->delete();

        return redirect()->route('kamar.index');
    }
}
