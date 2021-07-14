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
        $facilities = Facility::all()->where('status',true);
        $data = RoomType::where('id',$id)->get();
        return view('pages.admin.tipe.edit',[
            'data' => $data,
            'facilities' => $facilities
        ]);
    }

    public function update(Request $request, $id){
        $rules = [
            'name' => 'required|max:30|unique:room_types,name,'.$id,
            'photo' => 'image|max:2048|mimes:jpg,png,jpeg',
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
        $data = RoomType::where('id',$id)->first();
        $data->name = $request->name;
        $data->floor = $request->floor;
        $data->price = $request->price;
        $data->size = $request->size;
        $data->status = $request->status;
        if(request()->hasFile('photo')){
            $photo = request()->file('photo')->store('assets/roomtypes','public');
            $data->update(['photo' => $photo]);
        }
        $data->save();
        $data->facilities()->sync(array_keys($request->input('facility')));

        Alert::success('SUCCESS','Data Tipe Kamar Berhasil Diupdate');
        return redirect()->route('tipe.index');
    }


    public function destroy($id){
        $room_type = RoomType::findOrFail($id);
        $room_type->delete();

        // if($room_type->room()->count()){
        //     return back()->withErrors('error','Maaf tipe kamar tidak bisa dihapus');
        // }
        // foreach ($room_type->room as $room) {
        //     dd($room_type);
        //     foreach ($room->room_bookings as $booking) {
        //         $booking->delete();
        //     }
        //     $room->delete();
        // }

        return redirect()->route('tipe.index');
    }
}
