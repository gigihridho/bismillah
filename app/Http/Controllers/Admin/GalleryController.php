<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Room;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(){
        if(request()->ajax()){
            $query = Gallery::with('room');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '
                    <div class="btn-group">
                        <a class="btn btn-info edit" href="' . route('kamar.edit', $data->id) . '" >
                            Edit
                        </a>
                        <form action="' . route('kamar.destroy', $data->id) . '" method="POST"  style="margin-left:10%">
                            ' . method_field('delete') . csrf_field() . '
                            <button type="submit" class="btn btn-danger">
                                Hapus
                            </button>
                        </form>
                    </div>';
                })
                ->editColumn('photos', function($data){
                    return $data->photos ? '<img src="'. Storage::url($data->photos).'" style="max-height: 50px;"/>' : '';
                })
                ->rawColumns(['action','photos'])
                ->make();
        }
        return view('pages.admin.gallery.index');
    }
    public function edit(GalleryRequest $request){
        return view('pages.admin.gallery.edit');
    }

    public function create(){
        $rooms = Room::all();

        return view('pages.admin.gallery.create',[
            'rooms' => $rooms
        ]);
    }

    public function store(GalleryRequest $request){
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product','public');

        Gallery::create($data);
        return redirect()->route('gallery.index');
    }

    public function destroy($id){
        $data = Gallery::findOrFail($id);
        $data->delete();

        return redirect()->route('gallery.index');
    }
}
