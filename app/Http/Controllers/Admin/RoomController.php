<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomRequest;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(){
        if(request()->ajax()){
            $query = Room::with('room_type');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($item){
                    return '
                    <div class="btn-group">
                        <a class="btn btn-info edit" href="' . route('kamar.edit', $item->id) . '" >
                            Edit
                        </a>
                        <form action="' . route('kamar.destroy', $item->id) . '" method="POST"  style="margin-left:10%">
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

        return view('pages.admin.kamar.index');
    }

    public function create(){
        $room_types = RoomType::all();

        return view('pages.admin.kamar.create',[
            'room_types' => $room_types
        ]);
    }

    public function store(RoomRequest $request){
        $data = $request->all();

        $data['slug'] = $request->name;
        $data['status'] = $request->status;

        Room::create($data);
        return redirect()->route('kamar.index')->with('success','data berhasil ditambah');
    }

    public function edit($id){
        $item = Room::findOrFail($id);

        $room_types = RoomType::all();

        return view('pages.admin.kamar.edit',[
            'item' => $item,
            'room_types' => $room_types
        ]);
    }

    public function update(RoomRequest $request, $id){
        $data = $request->all();

        $data['slug'] = $request->name;
        $data['status'] = $request->status;

        $item = Room::findOrFail($id);

        $item->update($data);

        return redirect()->route('kamar.index');
    }

    public function destroy($id){
        $item = Room::findOrFail($id);
        $item->delete();

        return redirect()->route('kamar.index');
    }
}
