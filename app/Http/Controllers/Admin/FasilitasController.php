<?php

namespace App\Http\Controllers\Admin;

use App\Fasilitas;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FasilitasRequest;
use RealRashid\SweetAlert\Facades\Alert;

class FasilitasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $fasilitas = Fasilitas::all();
        return view('pages.admin.fasilitas.index',[
            'fasilitas' => $fasilitas
        ]);
    }

    public function create(){
        return view('pages.admin.fasilitas.create');
    }

    public function store(FasilitasRequest $request){
        $data = $request->all();

        Fasilitas::create($data);
        Alert::success('SUCCESS','Data Fasilitas Berhasil Ditambah');
        return redirect()->route('fasilitas.index');
    }

    public function edit($id){
        $fas = Fasilitas::where('id',$id)->first();

        return view('pages.admin.fasilitas.edit',[
            'fas' => $fas
        ]);
    }

    public function update(FasilitasRequest $request, $id){
        $data = $request->all();

        $item = Fasilitas::findOrFail($id);

        $item->update($data);
        Alert::success('SUCCESS','Data Fasilitas Berhasil Diupdate');
        // return redirect()->route('fasilitas.index');
    }

    public function destroy($id){
        $fas = Fasilitas::findOrFail($id);
        $fas->delete();

        // return redirect()->route('fasilitas.index');
    }
}
