<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use App\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index($id){
        $room_types = RoomType::find($id);

        return view('pages.admin.kamar.index',[
            'room_type' => $room_types
        ]);
    }
    public function create($id){
        $room_type = RoomType::find($id);

        return view('pages.admin.kamar.create',[
            'room_type' => $room_type
        ]);
    }

    public function store($id, Request $request){
        $rules = [
            'room_number' => 'required|numeric|max:99999|unique:rooms,room_number',
            'description' => 'max:200',
            'status' => 'boolean|required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all)
                ->withErrors($validator);
        } else {
        $room_type = RoomType::find($id);
        $room = new Room();
        $room->room_number = $request->input('room_number');
        $room->status = $request->input('status');

        $room->room_type()->associate($room_type);
        $room->save();

        Alert::success('SUCCESS','Data Kamar Berhasil Ditambah');
        return redirect('/admin/tipe/'.$id.'/kamar');
        }
    }

    public function edit($id,$room_id){
        $room_type = RoomType::find($id);
        $room =  Room::find($room_id);
        return view('pages.admin.kamar.edit',[
            'room_type' => $room_type,
            'room' => $room
        ]);
    }

    public function update($id, $room_id,Request $request){
        // $data = $request->all();

        // $data['slug'] = $request->name;
        // $data['status'] = $request->status;
        // $data['availability'] = $request->availability;

        // $item = Room::findOrFail($id);

        // $item->update($data);
        $rules = [
            'room_number' => 'required|numeric|max:99999|unique:rooms,room_number,'.$room_id,
            'status' => 'boolean|required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all)
                ->withErrors($validator);
        } else {
            $room = Room::find($room_id);
            $room->room_number = $request->input('room_number');
            if($request->has('available')){
                $room->available = $request->input('available');
            }
            $room->status = $request->input('status');
            $room->save();

        Alert::success('SUCCESS','Data Kamar Berhasil Diupdate');
        return redirect('admin/tipe/'.$id.'/kamar/');
        }
    }

    public function destroy($id, $room_id){
        $room = Room::findOrFail($room_id);

        foreach ($room->room_bookings as $booking) {
            $booking->delete();
        }

        if($room->delete()){
            return redirect('/admin/tipe/'.$id.'/kamar/');
        }
        return redirect()->back()->withErrors(array('message' => 'Maaf, data kamar tidak terhapus'));
    }
}
