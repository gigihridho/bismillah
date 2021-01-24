<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChangePassRequest;

class ChangePassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function change(){
        return view('pages.change-pass.index');
    }

    public function update(ChangePassRequest $request) {

        $command = User::findOrFail(Auth::user()->id)->update(['password'=> bcrypt($request->new_password)]);

        if ($command) {
            $request->session()->flash('alert-success', 'Password berhasil diganti!');
        } else {
            $request->session()->flash('alert-failed', 'Password gagal diganti!');
        }

        if(Auth::user()->role == 'user'){
            return redirect()->route('user.change-pass.index');
        }
        elseif (Auth::user()->role == 'admin')
        {
            return redirect()->route('admin.change-pass.index');
        }
    }
}
