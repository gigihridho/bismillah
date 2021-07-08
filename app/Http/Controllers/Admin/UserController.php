<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(){
        $users = User::all();
        return view('pages.admin.user.index',[
            'users' => $users,
        ]);
    }

    public function show($id){
        $user = User::where('id',$id)->get();
        return view('pages.admin.user.detail',[
            'user' => $user,
        ]);
    }

    public function destroy($id){
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('user.index');
    }
}
