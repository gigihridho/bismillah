<?php

namespace App\Http\Controllers\Admin;

use App\Facility;
use App\RoomType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\RoomTypeRequest;

class RoomTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $room_types = RoomType::with('facilities:name')->get();
        return view('pages.admin.tipe.index',[
            'room_types' => $room_types
        ]);
    }

    public function create(){
        $facilities = Facility::all()->where('status',true);
        return view('pages.admin.tipe.create',[
            'facilities' => $facilities
        ]);
    }

    public function store(RoomTypeRequest $request){
        $data = new RoomType();
        $data->name = $request->input('name');
        $data->slug = Str::slug($request->name);
        $data->photo = $request->file('photo')->store('assets/roomtypes','public');
        $data->floor = $request->input('floor');
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
        $data = RoomType::findOrFail($id);
        $facilities = Facility::where('status',true);
        return view('pages.admin.tipe.edit',[
            'data' => $data,
            'facilities' => $facilities
        ]);
    }

    public function update(Request $request, $id){
        $data = RoomType::find($id);
        $rules = [
            'name' => 'required|max:30|unique:room_types,name,'.$id,
            'photo' => 'required|image',
            'floor' => 'required|integer',
            'price' => 'required|integer',
            'size' => 'required|string',
            'facility' => 'array',
            'status' => 'required|boolean'
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        $data->name = $request->input('name');
        $data->slug = Str::slug($request->name);
        $data->photo = $request->file('photo')->store('assets/roomtypes','public');
        $data->floor = $request->input('floor');
        $data->price = $request->input('price');
        $data->size = $request->input('size');
        $data->status = $request->input('status');
        $data->save();

        $data->facilities()->sync(array_keys($request->input('facilites')));

        Alert::success('SUCCESS','Data Tipe Kamar Berhasil Diupdate');
        return redirect()->route('tipe.index');

    }


    public function destroy($id){
        $item = RoomType::findOrFail($id);
        $item->delete();

        return redirect()->route('tipe.index');
    }
}

    // public function index(){
    //     if(request()->ajax()){
    //         $query = RoomType::query();

    //         return Datatables::of($query)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($item){
    //                 return '
    //                 <div class="btn-group">
    //                     <a class="btn btn-info btn-sm edit" href="' . route('tipe.edit', $item->id) . '">
    //                         <i class="far fa-edit"></i> Edit
    //                     </a>
    //                     <a href="#" class="btn btn-danger btn-sm confirm-delete" style="margin-left:5px">
    //                         <i class="far fa-trash-alt"></i> Hapus
    //                     </a>

    //                 </div>';
    //             })
    //             ->editColumn('photo', function($item){
    //                 return $item->photo ? '<img src="'. Storage::url($item->photo).'" style="max-height: 70px;"/>' : '';
    //             })
    //             ->rawColumns(['action','photo'])
    //             ->make();
    //         }
    //     return view('pages.admin.tipe.index');
    // }
    // public function update(RoomTypeRequest $request, $id){
    //     $data = $request->all();

    //     $data['slug'] = Str::slug($request->name);
    //     $data['photo'] = $request->file('photo')->store('assets/roomtypes','public');
    //     $data['floor'] = $request->floor;
    //     $data['price'] = $request->price;
    //     $data['size'] = $request->size;
    //     $data['status'] = $request->status;
    //     $data['facilities'] = $request->facility;

    //     $item = RoomType::findOrFail($id);

    //     $item->update($data);
    //     Alert::success('SUCCESS','Data Tipe Kamar Berhasil Diupdate');
    //     return redirect()->route('tipe.index');
    // }
