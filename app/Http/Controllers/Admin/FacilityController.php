<?php

namespace App\Http\Controllers\Admin;

use App\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\FacilityRequest;


class FacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if(request()->ajax()){
            $query = Facility::query();

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
                                    <a class="dropdown-item" href="' . route('fasilitas.edit', $data->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('fasilitas.destroy', $data->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->editColumn('icon', function($data){
                    return $data->icon ? '<img src="'. Storage::url($data->icon).'" style="max-height: 30px;"/>' : '';
                })
                ->rawColumns(['action','icon'])
                ->make();
        }
        return view('pages.admin.fasilitas.index');
    }
    public function edit($id){
        $data = Facility::findOrFail($id);

        return view('pages.admin.fasilitas.edit');
    }

    public function create(){
        return view('pages.admin.fasilitas.create');
    }

    public function store(FacilityRequest $request){
        $id = $request->id;
        $data = $request->all();
        $data['name'] = $request->name;
        $data['icon'] = $request->file('icon')->store('assets/icon','public');
        Facility::create($data);
        return redirect()->route('fasilitas.index');
    }

    public function destroy($id){
        $data = Facility::findOrFail($id);
        $data->delete();
        return redirect()->route('fasilitas.index');
    }
}

