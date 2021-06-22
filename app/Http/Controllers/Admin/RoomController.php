<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomRequest;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    // public function index(){
    //     if(request()->ajax()){
    //         $query = Room::with('room_type');

    //         return Datatables::of($query)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($item){
    //                 return '
    //                 <div class="btn-group">
    //                     <a class="btn btn-sm btn-info edit" href="' . route('kamar.edit', $item->id) . '" >
    //                         <i class="far fa-edit"></i> Edit
    //                     </a>
    //                     <form action="' . route('kamar.destroy', $item->id) . '" method="POST" style="margin-left:5px">
    //                         ' . method_field('delete') . csrf_field() . '
    //                         <button type="submit" class="btn btn-sm btn-danger">
    //                             <i class="far fa-trash-alt"></i> Hapus
    //                         </button>
    //                     </form>
    //                 </div>';
    //             })
    //             ->rawColumns(['action'])
    //             ->make();
    //         }

    //     return view('pages.admin.kamar.index');
    // }

    public function index($id){
        $room_types = RoomType::find($id);

        return view('pages.admin.kamar.index',[
            'room_type' => $room_types
        ]);
    }
    public function create($id){
        $room_types = RoomType::find($id);

        return view('pages.admin.kamar.create',[
            'room_type' => $room_types
        ]);
    }

    public function store(RoomRequest $request){
        $data = $request->all();

        $data['slug'] = $request->name;
        $data['status'] = $request->status;
        $data['availability'] = $request->availability;

        Room::create($data);

        Alert::success('SUCCESS','Data Kamar Berhasil Ditambah');
        return redirect()->route('kamar.index');
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
        $data['availability'] = $request->availability;

        $item = Room::findOrFail($id);

        $item->update($data);

        Alert::success('SUCCESS','Data Kamar Berhasil Diupdate');
        return redirect()->route('kamar.index');
    }

    public function destroy($id){
        $item = Room::findOrFail($id);
        $item->delete();

        return redirect()->route('kamar.index');
    }
}
