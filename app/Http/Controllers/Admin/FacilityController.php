<?php

namespace App\Http\Controllers\Admin;

use App\Facility;
use Illuminate\Support\Str;
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
                ->addColumn('action', function($item){
                    return '
                        <div class="btn-group">
                            <a class="btn btn-info edit" href="' . route('fasilitas.edit', $item->id) . '" >
                                Edit
                            </a>
                            <form action="' . route('fasilitas.destroy', $item->id) . '" method="POST"  style="margin-left:10%">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </div>';
                })
                ->editColumn('icon', function($item){
                    return $item->icon ? '<img src="'. Storage::url($item->icon).'" style="max-height: 50px;"/>' : '';
                })
                ->rawColumns(['action','icon'])
                ->make();
        }
        return view('pages.admin.fasilitas.index');
    }
    public function edit($id){
        $item = Facility::findOrFail($id);

        return view('pages.admin.fasilitas.edit',[
            'item' => $item
        ]);
    }

    public function create(){
        return view('pages.admin.fasilitas.create');
    }

    public function update(FacilityRequest $request, $id){
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $data['icon'] = $request->file('icon')->store('assets/icon','public');

        $item = Facility::findOrFail($id);

        $item->update($data);

        return redirect()->route('fasilitas.index');

    }

    public function store(FacilityRequest $request){
        $data = $request->all();

        $data['slug'] = $request->name;
        $data['icon'] = $request->file('icon')->store('assets/icon','public');
        Facility::create($data);
        return redirect()->route('fasilitas.index')->with('success','data berhasil ditambah');
    }

    public function destroy($id){
        $item = Facility::findOrFail($id);
        $item->delete();
        return redirect()->route('fasilitas.index')->with('success','data berhasil dihapus');
    }
}

