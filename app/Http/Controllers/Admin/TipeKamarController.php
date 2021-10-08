<?php

namespace App\Http\Controllers\Admin;

use App\Fasilitas;
use App\TipeKamar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\TipeKamarRequest;

class TipeKamarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $tipe_kamars = TipeKamar::with('fasilitas:nama')->get();
        return view('pages.admin.tipe.index',[
            'tipe_kamars' => $tipe_kamars
        ]);
    }

    public function create(){
        $fasilitas = Fasilitas::all();
        return view('pages.admin.tipe.create',[
            'fasilitas' => $fasilitas
        ]);
    }

    public function store(TipeKamarRequest $request){
        $data = new TipeKamar();
        $data->nama = $request->input('nama');
        $data->foto = $request->file('foto')->store('assets/TipeKamars','public');
        $data->lantai = $request->input('lantai');
        $data->harga = $request->input('harga');
        $data->ukuran = $request->input('ukuran');
        $data->save();

        if($request->has('fas')){
            $data->fasilitas()->attach(array_keys($request->input('fas')));
        }

        Alert::success('SUCCESS','Data Tipe Kamar Berhasil Ditambah');
        return redirect()->route('tipe.index');
    }

    public function edit($id){
        $fasilitas = Fasilitas::all();
        $data = TipeKamar::where('id',$id)->get();
        return view('pages.admin.tipe.edit',[
            'data' => $data,
            'fasilitas' => $fasilitas
        ]);
    }

    public function update(Request $request, $id){
        $rules = [
            'nama' => 'required|max:30|unique:tipe_kamars,nama,'.$id,
            'foto' => 'image|max:2048|mimes:jpg,png,jpeg',
            'lantai' => 'required|integer',
            'harga' => 'required|integer',
            'ukuran' => 'required|string',
            'fasilitas' => 'array',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator);
        }
        $data = TipeKamar::where('id',$id)->first();
        $data->nama = $request->nama;
        $data->lantai = $request->lantai;
        $data->harga = $request->harga;
        $data->ukuran = $request->ukuran;
        if(request()->hasFile('foto')){
            $foto = request()->file('foto')->store('assets/TipeKamars','public');
            $data->update(['foto' => $foto]);
        }
        $data->save();
        $data->fasilitas()->sync(array_keys($request->input('fas')));

        Alert::success('SUCCESS','Data Tipe Kamar Berhasil Diupdate');
        return redirect()->route('tipe.index');
    }


    public function destroy($id){
        $tipe_kamar = TipeKamar::findOrFail($id);
        $tipe_kamar->delete();

        return redirect()->route('tipe.index');
    }
}
