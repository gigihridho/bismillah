<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(request()->ajax()){
            $query = Gallery::with('room');

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
                                    <a class="dropdown-item" href="' . route('gallery.edit', $data->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('gallery.destroy', $data->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
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
    public function edit(Request $request){
        return view('pages.admin.gallery.edit');
    }

    public function create(){
        $rooms = Room::all();

        return view('pages.admin.gallery.create',[
            'rooms' => $rooms
        ]);
    }

    public function store(Request $request){
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
