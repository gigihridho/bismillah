<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilUserController extends Controller
{
    public function user(){
        $user = auth()->user();
        return view('pages.user.profil.edit',[
            'user' => $user
            ]);
        }

    public function update(Request $request, $redirect){
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|numeric',
            'profession' => 'required',
            'address' => 'required',
        ],
        [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
        ]);
        $data = $request->all();

        $data['name'] = Str::slug($request->name);
        $data['email'] = $request->email;
        $data['no_hp'] = $request->no_hp;
        $data['photo_ktp'] = $request->file('photo_ktp')->store('assets/user','public');
        $data['profession'] = $request->profession;
        $data['address'] = $request->address;

        $item = Auth::user();

        $item->update($data);
        Alert::success('SUCCESS','Profil Berhasil diupdate');
        return redirect()->route($redirect);
    }
}
