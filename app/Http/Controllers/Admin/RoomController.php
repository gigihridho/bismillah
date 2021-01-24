<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        return view('pages.admin.kamar.index');
    }

    public function edit(){
        return view('pages.admin.kamar.edit');
    }

    public function create(){
        return view('pages.admin.kamar.create');
    }

    public function delete(){
        return view('pages.admin.kamar.index');
    }
}
