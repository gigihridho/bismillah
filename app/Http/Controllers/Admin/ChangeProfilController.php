<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangeProfilController extends Controller
{
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

        return redirect()->route($redirect);
    }
}
