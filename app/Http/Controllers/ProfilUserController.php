<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $data = $request->all();

        $item = auth()->user();

        $item->update($data);
        Alert::success('SUCCESS','Profil Berhasil diupdate');
        return redirect()->route($redirect);
    }
}
