<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(){
        $users = User::role('user')->get();
        return view('pages.admin.user.index',[
            'users' => $users,
        ]);
    }

    public function UserTidakAktif(){
        $data = User::where('status',false)->get();
        return view('pages.admin.user.index2',[
            'data' => $data
        ]);
    }

    public function show($id){
        $user = User::where('id',$id)->get();
        return view('pages.admin.user.detail',[
            'user' => $user,
        ]);
    }

    public function update(Request $request,$id){
        $user = User::where('id',$id)->first();
        $user->status = $request->status;
        $user->save();
        return redirect()->route('user-tidak-aktif');
    }

    public function destroy($id){
        $user = User::find($id);

        foreach ($user->room_bookings as $booking) {
            $booking->delete();
            $booking->room->availability = 'available';
        }
        $user->room_bookings->room->availability = 'available';
        $user->delete();

        return redirect()->route('user.index');
    }
}
