<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ChangeProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profil(){
        $user = auth()->user();

        return view('pages.admin.profil.edit',[
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
