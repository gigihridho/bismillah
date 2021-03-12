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
    public function index(){
        if(request()->ajax()){
            $query = Room::with('room_type');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($item){

                        $button = '<a href="'.route('kamar.edit', $item->id).'" data-toggle="tooltip"  data-id="'.$item->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$item->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Hapus</button>';
                        return $button;
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
// <a class="btn btn-info edit" href="' . route('kamar.edit', $item->id) . '" >
//                             Edit
//                         </a>
//                         <form action="' . route('kamar.destroy', $item->id) . '" method="POST"  style="margin-left:10%">
//                             ' . method_field('delete') . csrf_field() . '
//                             <button type="submit" class="btn btn-danger" name="delete">
//                                 Hapus
//                             </button>
//                         </form>
