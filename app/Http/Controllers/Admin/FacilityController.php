<?php

namespace App\Http\Controllers\Admin;

use App\Facility;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FacilityRequest;
use RealRashid\SweetAlert\Facades\Alert;

class FacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        $item = Facility::findOrFail($id);

        $item->update($data);
        Alert::success('SUCCESS','Data Fasilitas Berhasil Diupdate');
        return redirect()->route('fasilitas.index');
    }

    public function destroy($id){
        $item = Facility::findOrFail($id);
        $item->delete();

        return redirect()->route('fasilitas.index');
    }
}
