<?php

namespace App\Http\Controllers;

use App\TipeKamar;
use Illuminate\Http\Request;


class DetailController extends Controller
{

    public function detail(Request $request, $id)
    {
        $tipe_kamars = TipeKamar::where('id',$id)->get();
        $fasilitas = TipeKamar::with('fasilitas')->where('status',true)->get();
        return view('detail-kost', [
            'tipe_kamars' => $tipe_kamars,
            'fasilitas' => $fasilitas,
        ]);
    }
}
