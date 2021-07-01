<?php

namespace App\Http\Controllers\Admin;

use App\Facility;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\FacilityRequest;
use RealRashid\SweetAlert\Facades\Alert;

class FacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // public function index(){
    //     if(request()->ajax()){
    //         $query = Facility::query();

    //         return Datatables::of($query)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($item){
    //                 return '
    //                 <form action="' . route('fasilitas.destroy', $item->id) . '" method="POST">
    //                     <a class="btn btn-sm btn-info edit" href="' . route('fasilitas.edit', $item->id) . '" >
    //                         <i class="far fa-edit"></i> Edit
    //                     </a>
    //                         <a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="deleteConfirm({{ $item->id }})">
    //                         <i class="far fa-trash-alt" style="color: white;"></i>
    //                 </form>';
    //             })
    //             ->editColumn('icon', function($item){
    //                 return $item->icon ? '<img src="'. Storage::url($item->icon).'" style="max-height: 50px;"/>' : '';
    //             })
    //             ->rawColumns(['action','icon'])
    //             ->make();
    //     }
    //     return view('pages.admin.fasilitas.index');
    // }

    public function index(){
        $facilities = Facility::all();
        return view('pages.admin.fasilitas.index',[
            'facilites' => $facilities
        ]);
    }

    public function create(){
        return view('pages.admin.fasilitas.create');
    }

    public function store(FacilityRequest $request){
        $data = $request->all();

        $data['slug'] = $request->name;
        Facility::create($data);
        Alert::success('SUCCESS','Data Fasilitas Berhasil Ditambah');
        return redirect()->route('fasilitas.index');
    }

    public function edit($id){
        $item = Facility::findOrFail($id);

        return view('pages.admin.fasilitas.edit',[
            'item' => $item
        ]);
    }

    public function update(FacilityRequest $request, $id){
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        $item = Facility::findOrFail($id);

        $item->update($data);
        Alert::success('SUCCESS','Data Fasilitas Berhasil Diupdate');
        return redirect()->route('fasilitas.index');

    }



    public function destroy($id){
        $item = Facility::findOrFail($id);
        $item->delete();

        return redirect()->route('fasilitas.index');
        // $facility = Facility::findOrFail($id);
        // if($facility->delete()){
        //     return redirect()->route('fasilitas.index');
        // }
        // $facility->delete();
        // return redirect()->route('fasilitas.index');
    }
}

