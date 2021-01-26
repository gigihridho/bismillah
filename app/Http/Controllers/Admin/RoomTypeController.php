<?php

namespace App\Http\Controllers\Admin;

use App\RoomType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\RoomTypeRequest;
use App\Room;

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
                        <a class="btn btn-info edit" href="' . route('tipe.edit', $item->id) . '" >
                            Edit
                        </a>
                        <form action="' . route('tipe.destroy', $item->id) . '" method="POST"  style="margin-left:10%">
                            ' . method_field('delete') . csrf_field() . '
                            <button type="submit" class="btn btn-danger">
                                Hapus
                            </button>
                        </form>
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

    public function edit($id){
        $item = RoomType::findOrFail($id);

        return view('pages.admin.tipe.edit',[
            'item' => $item
        ]);
    }
    // public function show(){
    //     //
    // }

    public function update(RoomTypeRequest $request, $id){
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/facility','public');
        $data['description'] = $request->description;
        $data['price'] = $request->price;
        $data['size'] = $request->size;

        $item = RoomType::findOrFail($id);

        $item->update($data);

        return redirect()->route('tipe.index')->with('success','data berhasil diupdate');
    }
    public function create(){
        return view('pages.admin.tipe.create');
    }

    public function store(RoomTypeRequest $request){
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/facility','public');
        $data['description'] = $request->description;
        $data['price'] = $request->price;
        $data['size'] = $request->size;

        RoomType::create($data);
        return redirect()->route('tipe.index')->with('success','data berhasil ditambah');
    }

    public function destroy($id){
        $item = Room::findOrFail($id);
        $item->delete();
        return redirect()->route('tipe.index')->with('success','data berhasil dihapus');
    }
}
