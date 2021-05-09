<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use App\Facility;
use App\RoomType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\RoomTypeRequest;

class RoomTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(){
        if(request()->ajax()){
            $query = RoomType::query();

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($item){
                    return '
                    <div class="btn-group">
                        <a class="btn btn-info btn-sm edit" href="' . route('tipe.edit', $item->id) . '">
                            <i class="far fa-edit"></i> Edit
                        </a>
                        <a href="#" class="btn btn-danger btn-sm confirm-delete" style="margin-left:10px">
                            <i class="far fa-trash-alt"></i> Hapus
                        </a>

                    </div>';
                })
                ->editColumn('photo', function($item){
                    return $item->photo ? '<img src="'. Storage::url($item->photo).'" style="max-height: 70px;"/>' : '';
                })
                ->rawColumns(['action','photo'])
                ->make();
            }
        return view('pages.admin.tipe.index');
    }

    public function create(){
        $facilities = Facility::all();
        return view('pages.admin.tipe.create',[
            'facilities' => $facilities
        ]);
    }

    public function store(RoomTypeRequest $request){
        // $data = $request->all();

        $data = new RoomType();
        $data->name = $request->input('name');
        $data->slug = Str::slug($request->name);
        $data->photo = $request->file('photo')->store('assets/roomtypes','public');
        $data->description = $request->input('description');
        $data->price = $request->input('price');
        $data->size = $request->input('size');
        $data->save();
        if($request->has('facility')){
            $data->facilities()->attach(array_keys($request->input('facility')));
        }
        Alert::success('SUCCESS','Data Tipe Kamar Berhasil Ditambah');
        return redirect()->route('tipe.index');
    }

    public function edit($id){
        $item = RoomType::findOrFail($id);
        $facilities = Facility::all();
        return view('pages.admin.tipe.edit',[
            'item' => $item,
            'facilities' => $facilities
        ]);
    }

    public function update(RoomTypeRequest $request, $id){
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/roomtypes','public');
        $data['description'] = $request->description;
        $data['price'] = $request->price;
        $data['size'] = $request->size;
        $data['facilities'] = $request->facility;

        $item = RoomType::findOrFail($id);

        $item->update($data);
        Alert::success('SUCCESS','Data Tipe Kamar Berhasil Diupdate');
        return redirect()->route('tipe.index');
    }


    public function destroy($id){
        $item = RoomType::findOrFail($id);
        $item->delete();

        return redirect()->route('tipe.index');
    }
}
// <form action="' . route('tipe.destroy', $item->id) . '" method="POST" style="margin-left:5px">
//                             ' . method_field('delete') . csrf_field() . '

//                         </form>
